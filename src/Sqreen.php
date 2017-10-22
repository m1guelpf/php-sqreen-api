<?php

namespace M1guelpf\SqreenAPI;

use GuzzleHttp\Client;

class Sqreen
{
    /** @var \GuzzleHttp\Client */
    protected $client;

    /** @var string */
    protected $apiVersion;

    /**
     * @param \GuzzleHttp\Client $client
     * @param string             $apiToken
     * @param string             $apiVersion
     */
    public function __construct($apiToken = null, $apiVersion = 'v1')
    {
        $this->client = new Client();

        $this->apiToken = $apiToken;

        $this->baseUrl = 'https://api.sqreen.io/'.$apiVersion;
    }

    /**
     * @param string $apiToken
     *
     * @return string
     */
    public function connect($apiToken)
    {
        $this->apiToken = $apiToken;

        return $this->apiToken;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \GuzzleHttp\Client $client
     *
     * @return void
     */
    public function setClient($client)
    {
        if ($client instanceof Client) {
            $this->client = $client;
        }

        return $this;
    }

    /**
     * @param string $email
     *
     * @return array
     */
    public function emails($email)
    {
        return $this->get('/emails/'.$email);
    }

    /**
     * @param string $ip
     *
     * @return array
     */
    public function ips($ip)
    {
        return $this->get('/ips/'.$ip);
    }

    /**
     * @param string $method HTTP method
     * @param string $resource Resource to invoke at Sqreen API
     * @param array  $query Request query string to pass in the URL
     * @param array  $rawData Request body
     *
     * @return array
     */
    protected function handleCall($method, $resource, array $query, array $rawData)
    {
        $data['headers'] = [
          'X-API-Key' => $this->apiToken,
          'User-Agent' => 'php-sqreen-api'
        ];

        if(!empty($query)) {
          $data['query'] = $query;
        }

        if(!empty($rawData)) {
          $data['json'] = $rawdata;
        }

        $results = $this->client
            ->request($method, "{$this->baseUrl}{$resource}", $data)
            ->getBody()
            ->getContents();

        return json_decode($results, true);
    }


    /**
     * @param string $resource
     * @param array  $query
     *
     * @return array
     */
    protected function get($resource, array $query = [])
    {
      return $this->handleCall("GET", $resource, $query, []);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    protected function post($resource, array $rawData = [])
    {
      return $this->handleCall("POST", $resource, [], $rawData);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    protected function put($resource, array $rawData = [])
    {
        return $this->handleCall("PUT", $resource, [], $rawData);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    public function delete($resource, array $rawData = [])
    {
        return $this->handleCall("DELETE", $resource, [], $rawData);
    }
}

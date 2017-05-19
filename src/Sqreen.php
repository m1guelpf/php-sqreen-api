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
     * @param string             $apiKey
     * @param string             $apiVersion
     */
    public function __construct($apiToken = null, $apiVersion = 'v1')
    {
        $this->client = new Client();

        $this->apiToken = $apiToken;

        $this->baseUrl = 'https://api.sqreen.io'.$apiVersion;
    }

    /**
     * @param string $apiKey
     *
     * @return string
     */
    public function connect($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this->apiKey;
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
    public function email(string $email)
    {
        return $this->get('/emails/'.$email);
    }

    /**
     * @param string $ip
     *
     * @return array
     */
    public function ip(string $ip)
    {
        return $this->get('/ips/'.$ip);
    }

    /**
     * @param string $resource
     * @param array  $query
     *
     * @return array
     */
    protected function get($resource, array $query = [])
    {
        $data['headers'] = ['X-API-Key' => $this->apiToken, 'User-Agent' => 'php-sqreen-api'];
        $data['query'] = $query;
        $results = $this->client
            ->get("{$this->baseUrl}{$resource}", $data)
            ->getBody()
            ->getContents();

        return json_decode($results, true);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    protected function post($resource, array $rawdata = [])
    {
        $data['headers'] = ['X-API-Key' => $this->apiToken, 'User-Agent' => 'php-sqreen-api'];
        $data['json'] = $rawdata;
        $results = $this->client
            ->post("{$this->baseUrl}{$resource}", $data)
            ->getBody()
            ->getContents();

        return json_decode($results, true);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    protected function put($resource, array $rawdata = [])
    {
        $data['headers'] = ['X-API-Key' => $this->apiToken, 'User-Agent' => 'php-sqreen-api'];
        $data['json'] = $rawdata;
        $results = $this->client
            ->request('PUT', "{$this->baseUrl}{$resource}", $data)
            ->getBody()
            ->getContents();

        return json_decode($results, true);
    }

    /**
     * @param string $resource
     * @param array  $rawdata
     *
     * @return array
     */
    public function delete($resource, array $rawdata = [])
    {
        $data['headers'] = ['X-API-Key' => $this->apiToken, 'User-Agent' => 'php-sqreen-api'];
        $data['json'] = $rawdata;
        $results = $this->client
            ->request('DELETE', "{$this->baseUrl}{$resource}", $data)
            ->getBody()
            ->getContents();

        return json_decode($results, true);
    }
}

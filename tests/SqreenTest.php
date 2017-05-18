<?php

namespace M1guelpf\SqreenAPI\Test;

use GuzzleHttp\Client;
use M1guelpf\SqreenAPI\Sqreen;

class SqreenTest extends \PHPUnit_Framework_TestCase
{
    /** @var \M1guelpf\SqreenAPI\Sqreen */
    protected $sqreen;

    public function setUp()
    {
        $this->sqreen = new Sqreen();

        parent::setUp();
    }

    /** @test */
    public function it_does_not_have_token()
    {
        $this->assertNull($this->sqreen->apiToken);
    }

    /** @test */
    public function you_can_set_api_token()
    {
        $this->sqreen->connect('API_TOKEN');
        $this->assertEquals('API_TOKEN', $this->sqreen->apiToken);
    }

    /** @test */
    public function you_can_get_client()
    {
        $this->assertInstanceOf(Client::class, $this->sqreen->getClient());
    }

    /** @test */
    public function you_can_set_client()
    {
        $newClient = new Client(['base_uri' => 'http://foo.bar']);
        $this->assertInstanceOf(Client::class, $newClient);
        $this->assertNotEquals($this->sqreen->getClient(), $newClient);
        $this->sqreen->setClient($newClient);
        $this->assertEquals($newClient, $this->sqreen->getClient());
    }
}

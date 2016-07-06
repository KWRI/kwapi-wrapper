<?php

namespace KWApi\Service;

use GuzzleHttp\Client;
use KWApi\Models\Credential;
use KWApi\Models\Response;
use KWApi\Services\AbstractService;


class ServiceTest extends \PHPUnit_Framework_TestCase
{

    private $stub;
    private $credential;

    protected function setUp()
    {
        $this->credential = new Credential('abcdApiKey');
        $this->stub = $this->getMockForAbstractClass(AbstractService::class, array(new Client(), $this->credential));
    }


    public function testSuccessfulRequest()
    {
        $res = $this->stub->get('http://localhost:8001/v1/api_users');
        $this->assertInstanceOf(Response::class, $res);
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testSendBadRequest()
    {
        $res = $this->stub->get('http://localhost:8001/v1/api_users/0');
        $this->assertInstanceOf(Response::class, $res);
        $this->assertTrue($res->isError());
        $this->assertEquals('BadRequest', $res->getCause());
    }

    public function testSendConnectionError()
    {
        $res = $this->stub->post('http://nohost/v1/api_users/0');
        $this->assertInstanceOf(Response::class, $res);
        $this->assertTrue($res->isError());
        $this->assertEquals('ConnectionError', $res->getCause());
    }


}
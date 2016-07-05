<?php

namespace KWApi\Test;

class ApplicationTest extends TestCase
{

    
    public function testSuccessConstructSingletonService()
    {
        $apiUser = $this->app->apiUser();
        $this->assertInstanceOf('KWApi\\Services\\AbstractService', $apiUser);
        
        // Check if api user is same object with previous api user object
        $this->assertEquals($apiUser, $this->app->apiUser());
    }

    public function testGetEndpoint()
    {
        $this->assertEquals($this->app->getEndPoint(), $this->endPoint);
    }

    public function testFailConstructSingletonService()
    {
        $this->setExpectedException('BadMethodCallException');
        $this->app->nonExistMethodAndService();
        
    }

}
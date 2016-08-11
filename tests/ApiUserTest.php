<?php

namespace KWApi\Test;

use KWApi\Models\Response;

class ApiUserTest extends TestCase
{

    protected $testApiKey;
    protected $testEmail;
    protected $testCompany;

    protected function setUp()
    {
        parent::setUp();

        // Set up fixtures
        $this->testApiKey = rand() . 'myTestApiKey';
        $this->testEmail = 'mytestemail@test.com';
        $this->testCompany = 'MyCompany';
        $this->testApplication = 'MyApplication';
    }

    public function testCreateApiUser()
    {

        $res = $this->app->apiUser()->create($this->testApiKey, $this->testEmail, $this->testCompany, $this->testApplication);
        $this->assertInstanceOf('KWApi\\Models\\Response', $res);
        $this->assertEquals(200, $res->getStatusCode());
        $createdId = $res->getBody()['id'];
        $this->app->apiUser()->delete($createdId);
    }

    public function testDelete()
    {
        $res = $this->app->apiUser()->create($this->testApiKey, $this->testEmail, $this->testCompany, $this->testApplication);
        $createdId = $res->getBody()['id'];

        $res = $this->app->apiUser()->delete($createdId);

        $this->assertInstanceOf('KWApi\\Models\\Response', $res);
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testViewApiUser()
    {
        $res = $this->app->apiUser()->read(1);

        $this->assertInstanceOf('KWApi\\Models\\Response', $res);
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testBrowseApiUserList()
    {
        $res = $this->app->apiUser()->browse(1);

        $this->assertInstanceOf('KWApi\\Models\\Response', $res);
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertArrayHasKey('data', $res->getBody());

    }

    public function testUpdateApiUser()
    {
        $res = $this->app->apiUser()->create($this->testApiKey, $this->testEmail, $this->testCompany, $this->testApplication);
        $createdId = $res->getBody()['id'];

        $newEmail = 'new' . $this->testEmail;
        $res = $this->app->apiUser()->update(
            $createdId, 
            $this->testApiKey, 
            $newEmail, 
            $this->testCompany, 
            $this->testApplication
        );
        $this->assertInstanceOf('KWApi\\Models\\Response', $res);
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals($newEmail, $res->getBody()['email']);

        $this->app->apiUser()->delete($createdId);
    }

    public function testToggle()
    {
        $res = $this->app->apiUser()->create($this->testApiKey, $this->testEmail, $this->testCompany, $this->testApplication);
        $this->apiKey = $this->testApiKey;
        $this->app = $this->createApplication();
        
        $res = $this->app->apiUser()->toggle(1);

        $this->assertInstanceOf('KWApi\\Models\\Response', $res);
        $this->assertEquals(200, $res->getStatusCode());

        // Retoggle api user to make it to previous state
        $this->app->apiUser()->toggle(1);
    }
    
}
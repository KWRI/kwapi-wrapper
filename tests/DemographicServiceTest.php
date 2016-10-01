<?php

namespace KWApi\Test;

class DemographicServiceTest extends TestCase
{
    protected $demographic;

    protected function setUp()
    {
        parent::setUp();
        $this->demographic = $this->app->demographic();
    }

    public function testDemographics()
    {
        $data = ['d_email'=>'bart@fullcontact.com'];
        $res = $this->demographic->getDemographics($data);
        $this->assertEquals(200, $res->getStatusCode());
    }

}
<?php

namespace KWApi\Test;

class PeopleServiceTest extends TestCase
{
    protected $people;

    protected function setUp()
    {
        parent::setUp();
        $this->people = $this->app->people();
    }

    public function testLookupEmail()
    {
        $res = $this->people->lookupEmail('bart@fullcontact.com');
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testLookupPhone()
    {
        $res = $this->people->lookupPhone('+13037170414');
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testLookupPhoneFailed()
    {
        $res = $this->people->lookupPhone('+6281460000109');
        $this->assertNotEquals(200, $res->getStatusCode());
    }

}
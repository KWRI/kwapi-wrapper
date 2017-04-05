<?php

namespace KWApi\Test;

class GoalServiceTest extends TestCase
{
    protected $goal;

    protected function setUp()
    {
        parent::setUp();
        $this->goal = $this->app->goal();
    }

    public function testGetGoal()
    {
        $res = $this->goal->getGoal('345');
        $this->assertNotEquals(200, $res->getStatusCode());
    }

}
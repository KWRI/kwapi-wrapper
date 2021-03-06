<?php

namespace KWApi\Test;

class LeadRoutingTest extends TestCase
{
    protected $leadRouting;

    protected function setUp()
    {
        parent::setUpOpenID();
        $this->leadRouting = $this->app->leadRouting();
    }

    public function testList()
    {
        $res = $this->leadRouting->lists();
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testAll()
    {
        $res = $this->leadRouting->all();
        $this->assertEquals(200, $res->getStatusCode());
    }

    private function createList($data)
    {
        extract($data);

        return $this->leadRouting->createList($name, $router, $hash);
    }

    public function deleteList($id)
    {
        return $this->leadRouting->removeList($id);
    }

    public function testCreateList()
    {
        $data = [
            'name' => 'Test create list name',
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];

        $res = $this->createList($data);
        $this->assertEquals(200, $res->getStatusCode());
        $this->deleteList($res->getBody()['id']);
    }

    public function testReadList()
    {
        $data = [
            'name' => 'Test read list',
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];
        $res = $this->createList($data);

        $res = $this->leadRouting->readList($res->getBody()['id']);
        $this->assertEquals(200, $res->getStatusCode());
        $this->deleteList($res->getBody()['id']);
    }

    public function testUpdateList()
    {
        $data = [
            'name' => 'Test update list',
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];
        $newData = [
            'name' => 'Test update list new name',
            'router' => 'RoundRobin',
            'hash' => 'newhash'
        ];

        $id = $this->createList($data)->getBody()['id'];
        $res = $this->leadRouting->updateList($id, $newData['name'], $newData['router'], $newData['hash']);
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals($newData['name'], $res->getBody()['name']);
        $this->deleteList($id);
    }

    public function testCreateAgent()
    {
        $data = [
            'name' => 'Test create agent',
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];

        $agentName = 'Test new agent name';
        $agentId = 'test_new_agent_id' . time();
        $email = '2light.hidayah@gmail.com';

        $res = $this->createList($data);

        $res = $this->leadRouting->createAgent($res->getBody()['id'], $agentName, $agentId, $email);

        $this->assertEquals(200, $res->getStatusCode());
        $this->deleteList($res->getBody()['id']);
    }


    public function testCreateAgents()
    {
        $data = [
            'name' => 'Test create agents',
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];

        $rows = [
            ['name' => 'Test agent 1', 'agent_id' => 'test_agent_1_id' . time(), 'email' => '2light.hidayah@gmail.com'],
            ['name' => 'Test agent 2', 'agent_id' => 'test_agent_2_id' . time(), 'email' => 'nurcahyo.hidayah@gmail.com']
        ];

        $id = $this->createList($data)->getBody()['id'];
        $res = $this->leadRouting->createAgents($id, $rows);

        $this->assertEquals(200, $res->getStatusCode());
        $this->deleteList($id);
    }

    public function testAssignLead()
    {
        $data = [
            'name' => 'Test assign lead',
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];

        $rows = [
            ['name' => 'Test agent 1', 'agent_id' => 'test_agent_1_id' . time(), 'email' => '2light.hidayah@gmail.com'],
            ['name' => 'Test agent 2', 'agent_id' => 'test_agent_2_id' . time(), 'email' => 'nurcahyo.hidayah@gmail.com']
        ];

        // create a list
        $id = $this->createList($data)->getBody()['id'];
        // crate an agents
        $this->leadRouting->createAgents($id, $rows);

        $res = $this->leadRouting->assignLead($id, 'Test_Lead_info_1', 1);
        $this->assertEquals(200, $res->getStatusCode());
        $this->deleteList($id);
    }

    public function testListStats()
    {
        $data = [
            'name' => 'Test list stats',
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];

        $id = $this->createList($data)->getBody()['id'];

        $res = $this->leadRouting->listStats($id);

        $this->assertEquals(200, $res->getStatusCode());

        $this->deleteList($id);
    }

    public function testDeleteList()
    {
        $data = [
            'name' => 'Test delete list',
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];

        $res = $this->createList($data);
        $res = $this->deleteList($res->getBody()['id']);
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testAgents()
    {
        $listData = [
            'name' => 'Test list name' . time(),
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];

        $listId = $this->createList($listData)->getBody()['id'];

        $res = $this->leadRouting->agents($listId);
        $this->assertEquals(200, $res->getStatusCode());
        $this->deleteList($listId);
    }

    public function testReadAgent()
    {
        $listData = [
            'name' => 'Test list name' . time(),
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];

        $rows = [
            ['name' => 'Test agent 1', 'agent_id' => 'test_agent_1_id' . time(), 'email' => '2light.hidayah@gmail.com'],
            ['name' => 'Test agent 2', 'agent_id' => 'test_agent_2_id' . time(), 'email' => 'nurcahyo.hidayah@gmail.com']
        ];


        $listId = $this->createList($listData)->getBody()['id'];

        // create an agents
        $agentId = $this->leadRouting->createAgents($listId, $rows)->getBody()[0]['id'];

        $res = $this->leadRouting->readAgent($listId, $agentId);
        $this->assertEquals(200, $res->getStatusCode());
        $this->deleteList($listId);
    }

    public function testAgentStats()
    {
        $listData = [
            'name' => 'Test list name' . time(),
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];

        $rows = [
            ['name' => 'Test agent 1', 'agent_id' => 'test_agent_1_id' . time(), 'email' => '2light.hidayah@gmail.com'],
            ['name' => 'Test agent 2', 'agent_id' => 'test_agent_2_id' . time(), 'email' => 'nurcahyo.hidayah@gmail.com']
        ];


        $listId = $this->createList($listData)->getBody()['id'];

        // create an agents
        $agentId = $this->leadRouting->createAgents($listId, $rows)->getBody()[0]['id'];

        $res = $this->leadRouting->agentStats($listId, $agentId);
        $this->assertEquals(200, $res->getStatusCode());
        $this->deleteList($listId);
    }

    public function testRemoveAgent()
    {
        $listData = [
            'name' => 'Test list name' . time(),
            'router' => 'RoundRobin',
            'hash' => 'hashkey'
        ];

        $rows = [
            ['name' => 'Test agent 1', 'agent_id' => 'test_agent_1_id' . time(), 'email' => '2light.hidayah@gmail.com'],
            ['name' => 'Test agent 2', 'agent_id' => 'test_agent_2_id' . time(), 'email' => 'nurcahyo.hidayah@gmail.com']
        ];


        $listId = $this->createList($listData)->getBody()['id'];

        // create an agents
        $agentId = $this->leadRouting->createAgents($listId, $rows)->getBody()[0]['id'];

        $res = $this->leadRouting->removeAgent($listId, $agentId);
        $this->assertEquals(200, $res->getStatusCode());
        $this->deleteList($listId);
    }

    public function testLeads()
    {

    }

}

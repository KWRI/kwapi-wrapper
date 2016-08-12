<?php

namespace KWApi\Services;

class LeadRoutingService extends AbstractService
{
    /**
     * View all available List
     *
     * @param array $queryData    Query data must be contains: page, _filters, _perPage, _sortField, and _sortDir
     *
     * @return \KWApi\Models\Response
     */
    public function lists($queryData = array())
    {
        return $this->get('lists', $queryData);
    }

    /**
     * Display all list include non api key user's list
     *
     * @param array $queryData    Query data must be contains: page, _filters, _perPage, _sortField, and _sortDir
     *
     * @return \KWApi\Models\Response
     */
    public function all($queryData = array())
    {

        return $this->get('lists/all', $queryData);
    }


    /**
     * Create a List
     *
     * @param string $name      List name
     * @param string $router    eg: RoundRobin
     * @param string $hash      Hash Key
     *
     * @return \KWApi\Models\Response
     */
    public function createList($name, $router, $hash)
    {
        return $this->post('lists', compact('name', 'router', 'hash'));
    }



    /**
     * Display a List
     *
     * @param int $id  List ID
     *
     * @return \KWApi\Models\Response
     */
    public function readList($id)
    {
        return $this->get('lists/' . $id);
    }

    /**
     * Update a List
     *
     * @param int $id       List ID
     * @param string $name      List name
     * @param string $router    Router  eg: RoundRobin
     * @param string $hash      Hash key
     *
     * @return \KWApi\Models\Response
     */
    public function updateList($id, $name, $router, $hash)
    {
        return $this->send('PUT', 'lists/' . $id , ['form_params' => compact('name', 'router', 'hash')]);
    }

    /**
     * Create an Agent on specific list
     *
     * @param int $id       List ID
     * @param string $name      Agent name
     * @param string $agent_id  Agent identifier
     * @param string $email     Agent email address
     *
     * @return \KWApi\Models\Response
     */
    public function createAgent($id, $name, $agent_id, $email)
    {
        return $this->post('lists/' . $id . '/agents', compact('name', 'agent_id', 'email'));
    }

    /**
     * Bulk create multiple Agents on specific list
     *
     * @param int $id       List ID
     * @param array $data   Row contains agents Data
     *
     * @return \KWApi\Models\Response
     */
    public function createAgents($id, $data)
    {
        return $this->post('lists/' . $id . '/agents/bulkadd', ['agents' => $data]);
    }

    /**
     * Assign an agent a lead
     *
     * @param int $id                   List ID
     * @param string $lead_info         Lead info
     * @param int $approval_timeout     Timeout for an agent to approve in hour
     *
     * @return \KWApi\Models\Response
     */
    public function assignLead($id, $lead_info, $approval_timeout = 1)
    {
       return $this->post('lists/' . $id . '/assign', compact('lead_info', 'approval_timeout'));
    }

    /**
     * Display a list stats
     *
     * @param int $id   List ID
     *
     * @return \KWApi\Models\Response
     */
    public function listStats($id)
    {
       return $this->get('lists/' . $id . '/stats');
    }

    /**
     * Delete a list include all related agents & leads
     *
     * @param $id   List ID
     *
     * @return \KWApi\Models\Response
     */
    public function removeList($id)
    {
        return $this->send('DELETE', 'lists/' . $id);
    }

    /**
     * Show list of agents from a routing list
     *
     * @param int $listId       List ID
     * @param array $queryData
     *
     * @return \KWApi\Models\Response
     */
    public function agents($listId, $queryData = array())
    {
        return $this->get('lists/' . $listId . '/agents', $queryData);
    }

    /**
     * Show detail of an listAgent
     *
     * @param int $listId       List ID
     * @param int $agentId      Agent ID
     *
     * @return \KWApi\Models\Response
     */
    public function readAgent($listId, $agentId)
    {
        return $this->get('lists/' . $listId . '/agents/' . $agentId);
    }


    /**
     * Show stats of agent
     *
     * @param int $listId       List ID
     * @param int $agentId      Agent ID
     *
     * @return \KWApi\Models\Response
     */
    public function agentStats($listId, $agentId)
    {
        return $this->get('lists/' . $listId . '/agents/' . $agentId . '/stats');
    }


    /**
     * Remove listAgent from list
     *
     * @param int $listId       List ID
     * @param int $agentId      Agent ID
     *
     * @return \KWApi\Models\Response
     */
    public function removeAgent($listId, $agentId)
    {
        return $this->send('DELETE', 'lists/' . $listId . '/agents/' . $agentId);
    }

    /**
     * Show list lead of routing list
     *
     * @param int $id           Lead ID
     * @param int $queryData    
     *
     * @return \KWApi\Models\Response
     */
    public function leads($id, $queryData = array())
    {
        return $this->get('lists/' . $id . '/leads', $queryData);
    }


    /**
     * Show detail of lead
     *
     * @param int $listId       List ID
     * @param int $leadId       Leads ID
     *
     * @return \KWApi\Models\Response
     */
    public function readLead($listId, $leadId)
    {
        return $this->get('lists/' . $listId . '/leads/' . $leadId);
    }

    /**
     * Mark leads as completed
     * @return \KWApi\Models\Response
     */
    public function markCompleteLead($leadId)
    {
        return $this->post('leads/' . $leadId . '/mark');
    }

    /**
     * Respond Assignment
     * @return \KWApi\Models\Response
     */
    public function respondAssignment($leadId, $respondBool = false)
    {
        $respond = $respondBool ? 1 : 0;
        return $this->get('leads/' . $leadId . '/respond_assignment', compact('respond'));
    }

}
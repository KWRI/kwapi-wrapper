'use strict';
const AbstractService = require('./AbstractService')
const _ = require('lodash')

class LeadRoutingService extends AbstractService {
    /**
    * View all available List
    *
    * @param array queryData    Query data must be contains: page,
    _filters, _perPage, _sortField, and _sortDir
    *
    * @return \KWApi\Models\Response
    */
    lists(queryData) {
        return this.get('lists', queryData)
    }

    /**
    * Display all list include non api key user's list
    *
    * @param array queryData    Query data must be contains: page,
    _filters, perPage, _sortField, and _sortDir
    *
    * @return \KWApi\Models\Response
    */
    all(queryData) {
        return this.get('lists/all', queryData)
    }

    /**
    * Create a List
    *
    * @param string name      List name
    * @param string router    eg: RoundRobin
    * @param string hash      Hash Key
    *
    * @return \KWApi\Models\Response
    */
    createList(name, router, hash) {
        const params = { name, router, hash }
        return this.post('lists', params)
    }

    /**
    * Display a List
    *
    * @param int id  List ID
    *
    * @return \KWApi\Models\Response
    */
    readList(id) {
        return this.get(`lists/${id}`)
    }

    /**
    * Update a List
    *
    * @param int id       List ID
    * @param string name      List name
    * @param string router    Router  eg: RoundRobin
    * @param string hash      Hash key
    *
    * @return \KWApi\Models\Response
    */
    updateList(id, name, router, hash) {
        const params = { name, router, hash }
        return this.put(`lists/${id}`, params)
    }

    /**
    * Create an Agent on specific list
    *
    * @param int id       List ID
    * @param string name      Agent name
    * @param string kw_uid    Agent identifier
    * @param string email     Agent email address
    * @param boolean active   Agent state (default to active)
    *
    * @return \KWApi\Models\Response
    */
    /* eslint-disable */
    createAgent(id, name, kw_uid, email, active = true) {
        const [first_name, last_name] = name.split(' ')
        return this.post(`list/${id}/agents`, { first_name, last_name, kw_uid, email, active })
    }
    /* eslint-enable */
    /**
    * Bulk create multiple Agents on specific list
    *
    * @param int id       List ID
    * @param array data   Row contains agents Data
    *
    * @return \KWApi\Models\Response
    */
    createAgents(id, data) {
        const agents = {}
        const params = {}
        let pos = 0

        _.map(data, (agent) => {
            const item = agent
            item.kw_uid = item.email
            if (item.name) {
                item.first_name = item.name.substr(0, item.name.indexOf(' '))
                item.last_name = item.name.substr(item.name.indexOf(' '))
            }
            /* eslint-disable */
            if (!item.hasOwnProperty('active')) {
                item["active"] = true
            }

            agents[pos] = item
            pos += 1
        })

        params.agents = agents

        return this.post(`list/${id}/agents/bulkadd`, params)
    }

    /**
    * Assign an agent a lead
    *
    * @param int id                   List ID
    * @param string lead_info         Lead info
    * @param int approval_timeout     Timeout for an agent to approve in hour
    *
    * @return \KWApi\Models\Response
    */
    assignLead(id, lead_info, approval_timeout) {
        return this.post(`lists/${id}/assign`, { lead_info: lead_info , approval_timeout: 1 })
    }

    /**
     * Display a list stats
     *
     * @param int $id   List ID
     *
     * @return \KWApi\Models\Response
     */
    listStats(id) {
        return this.get(`lists/${id}/stats`)
    }

    /**
    * Delete a list include all related agents & leads
    *
    * @param $id   List ID
    *
    * @return \KWApi\Models\Response
    */
    removeList(id) {
        return this.send('DELETE', `lists/${id}`)
    }

    /**
    * Show list of agents from a routing list
    *
    * @param int listId       List ID
    * @param array queryData
    *
    * @return \KWApi\Models\Response
    */
    agents(listId, queryData) {
        return this.get(`list/${listId}/agents`, queryData)
    }

    /**
    * Show detail of an listAgent
    *
    * @param int listId       List ID
    * @param int agentId      Agent ID
    *
    * @return \KWApi\Models\Response
    */
    readAgent(listId, agentId) {
        return this.get(`list/${listId}/agents/${agentId}`)
    }

    /**
    * Show stats of agent
    *
    * @param int listId       List ID
    * @param int agentId      Agent ID
    *
    * @return \KWApi\Models\Response
    */
    agentStats(listId, agentId) {
        return this.get(`list/${listId}/agents/${agentId}/stats`)
    }

    /**
    * Remove listAgent from list
    *
    * @param int listId       List ID
    * @param int agentId      Agent ID
    *
    * @return \KWApi\Models\Response
    */
    removeAgent(listId, agentId) {
        return this.send('DELETE', `list/${listId}/agents/${agentId}`)
    }
    /**
    * Show list lead of routing list
    *
    * @param int id           Lead ID
    * @param int queryData
    *
    * @return \KWApi\Models\Response
    */
    leads(id, queryData) {
        return this.get(`lists/${id}/leads`, queryData)
    }

    /**
    * Show detail of lead
    *
    * @param int listId       List ID
    * @param int leadId       Leads ID
    *
    * @return \KWApi\Models\Response
    */
    readLead(listId, leadId) {
        return this.get(`lists/${listId}/leads/${leadId}`)
    }

    /**
    * Mark leads as completed
    * @return \KWApi\Models\Response
    */
    markCompleteLead(leadId) {
        return this.post(`leads/${leadId}/mark`)
    }

    /**
    * Respond Assignment
    * @return \KWApi\Models\Response
    */
    respondAssignment(leadId, respondBool = true) {
        const respond = respondBool ? 1 : 0
        return this.get(`leads/${leadId}/respond_assignment`, { respond })
    }
}

module.exports = LeadRoutingService

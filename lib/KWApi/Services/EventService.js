'use strict';
const AbstractService = require('./AbstractService')

class EventService extends AbstractService {
    /**
     * Register is for publisher who want to dispatch information to other services or applications.
     *
     * @param string object
     * @param string action
     * @param int version
     * @param string jsonSchema
     *
     * @return \KWApi\Models\Response Return response object
     */
    register(object, action, version, jsonSchema) {
        const param = { object, action, version, jsonSchema }
        return this.post('events/register', param)
    }

    /**
     * Subscribe is for services or applications that needs to receive dispatched event containing
     * information
     *
     * @param string object
     * @param string action
     * @param int version
     * @param string endPoint
     *
     * @return \KWApi\Models\Response Return response object
     */
    subscribe(object, action, version, endPoint) {
        const param = { object, action, version, endPoint }
        return this.post('events/subscribe', param)
    }

    /**
     * Add event message that need to dispatch to subscriber services or applications.
     *
     * @param string object
     * @param string action
     * @param int version
     * @param string event     Event name
     *
     * @return \KWApi\Models\Response Return response object
     */
    add(object, action, version, event) {
        const param = { object, action, version, event }
        return this.post('events/add', param)
    }

    /**
     * List events data, paginated 10 events every page
     *
     * @param int page     Number of page to show
     *
     * @return \KWApi\Models\Response Return response object
     */
    browse(page) {
        return this.get('events', page ? { page } : {})
    }

    /**
     * Show detail of event
     *
     * @param int id       EventID
     *
     * @return \KWApi\Models\Response Return response object
     */
    read(id) {
        return this.get(`events/${id}`)
    }

    /**
     * Show subscribers of event
     *
     * @param int eventId        Event ID
     *
     * @return \KWApi\Models\Response Return response object
     */
    browseSubscriber(eventId) {
        return this.get(`events/${eventId}/subscribers`)
    }

    /**
     * Updating event data
     *
     * @param int id               Event ID
     * @param string object        Event object name
     * @param string action        Event action
     * @param int version          Event version
     * @param string jsonSchema    Event json schema
     */
    update(id, object, action, version, jsonSchema) {
        const params = { object, action, version, jsonSchema }
        return this.put(`events/${id}`, params)
    }

    /**
     * Delete an event by ID
     *
     * @param int id   EventID
     *
     * @return \KWApi\Models\Response Return response object
     */
    delete(id) {
        return this.send('DELETE', `events/${id}`)
    }

    /**
     * To be used by api user for unsubscribing event message data
     *
     * @param string object
     * @param string action
     * @param int version
     *
     * @return \KWApi\Models\Response Return response object
     */
    unsubscribe(object, action, version) {
        const param = { object, action, version }
        return this.post('events/unsubscribe', param)
    }
}

module.exports = EventService

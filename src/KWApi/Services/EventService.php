<?php

namespace KWApi\Services;

class EventService extends AbstractService
{
    /**
     * Register is for publisher who want to dispatch information to other services or applications.
     *
     * @param string $object
     * @param string $action
     * @param int $version
     * @param string $jsonSchema
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function register($object, $action, $version, $jsonSchema)
    {
        return $this->post('events/register', compact('object', 'action', 'version', 'jsonSchema'));
    }


    /**
     * Subscribe is for services or applications that needs to receive dispatched event containing information
     *
     * @param string $object
     * @param string $action
     * @param int $version
     * @param string $endPoint
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function subscribe($object, $action, $version, $endPoint)
    {
        return $this->post('events/subscribe', compact('object', 'action', 'version', 'endPoint'));
    }


    /**
     * Add event message that need to dispatch to subscriber services or applications.
     *
     * @param string $object
     * @param string $action
     * @param int $version
     * @param string $event     Event name
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function add($object, $action, $version, $event)
    {
        return $this->post('events/add', compact('object', 'action', 'version', 'event'));
    }


    /**
     * List events data, paginated 10 events every page
     *
     * @param int $page     Number of page to show
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function browse($page = null)
    {
        $query = is_null($page) ? [] : ['page' => $page];
        return $this->get('events', $query);
    }


    /**
     * Show detail of event
     *
     * @param int $id       EventID
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function read($id)
    {
        return $this->get('events/' . $id);
    }


    /**
     * Show subscribers of event
     *
     * @param int $eventId        Event ID
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function browseSubscriber($eventId)
    {
        return $this->get('events/' . $eventId . '/subscriber');
    }

    /**
     * Updating event data
     *
     * @param int $id               Event ID
     * @param string $object        Event object name
     * @param string $action        Event action
     * @param int $version          Event version
     * @param string $jsonSchema    Event json schema
     */
    public function update($id, $object, $action, $version, $jsonSchema)
    {

        $params = compact('object', 'action', 'version', 'jsonSchema');

        return $this->send('PUT', 'events/' . $id, ['json' => $params]);
    }


    /**
     * Delete an event by ID
     *
     * @param int $id   EventID
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function delete($id)
    {
        return $this->send('DELETE', 'events/' . $id);
    }


    /**
     * To be used by api user for unsubscribing event message data
     *
     * @param string $object
     * @param string $action
     * @param int $version
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function unsubscribe($object, $action, $version)
    {
        return $this->post('events/unsubscribe', compact('object', 'action', 'version'));
    }
}

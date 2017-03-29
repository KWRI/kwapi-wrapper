<?php
/**
 * Created by PhpStorm.
 * User: abdulwahab
 * Date: 18/01/2017
 * Time: 10:30 AM
 */

namespace KWApi\Services;


class GoogleApiService extends AbstractService
{
    /**
     * Backend connect
     * @param $redirect
     * @return \KWApi\Models\Response
     */
    public function connect($redirect)
    {
        return $this->get('connect/google', ['redirect' => $redirect]);
    }

    /**
     * Backend Authenticate
     * @return \KWApi\Models\Response
     */
    public function authenticate($accessToken, $redirect)
    {
        return $this->get('connect/authenticate', ['code' => $accessToken, 'redirect' => $redirect]);
    }

    /**
     * Check if email exists in access_token table
     * @return \KWApi\Models\Response
     */
    public function checkAccess($email)
    {
        return $this->get('google/check/access', ['email' => $email]);
    }

    /**
     * Save Access Token
     *
     * @param $email
     * @param $access_token
     *
     * @return \KWApi\Models\Response
     */
    public function storeAccessToken($email, $access_token)
    {
        return $this->post('google/access_token', compact('email', 'access_token'));
    }

    /**
     * Get Mails
     *
     * @param $email
     * @param $filter
     * @param $pageToken
     * @return \KWApi\Models\Response
     */
    public function mails($email, $filter = null, $pageToken = null)
    {
        return $this->get("google/mail", ['email' => $email, 'filter' => $filter, 'pageToken' => $pageToken]);
    }

    /**
     * Get Mail Detail
     *
     * @param $mailId
     * @param $email
     * @param array $fields
     * @return \KWApi\Models\Response
     */
    public function mailDetail($mailId, $email, $fields = ['raw', 'id', 'labelIds', 'internalDate'])
    {
        return $this->get('google/mail/' . $mailId, ['email' => $email, 'fields' => $fields]);
    }

    /**
     * Send Mail
     *
     * @param $email,
     * @param $subject,
     * @param $fromName,
     * @param $toName,
     * @param $toEmail,
     * @param $mailBody
     * @return \KWApi\Models\Response
     */
    public function sendMail($email, $subject, $fromName, $toName, $toEmail, $mailBody)
    {
        return $this->post('google/mail', compact('email', 'subject', 'fromName', 'toName', 'toEmail', 'mailBody'));
    }

    /**
     * Get Calendar List
     *
     * @param $email
     * @return \KWApi\Models\Response
     */
    public function calendarList($email)
    {
        return $this->get('google/calendar/list', ['email'=>$email ]);
    }

    /**
     * Calendar Sync Watch
     *
     * @param $email,
     * @param $calendar_id,
     * @param $endpoint,
     * @return \KWApi\Models\Response
     */
    public function calendarSyncWatch($email, $calendar_id, $endpoint)
    {
        return $this->post('gcal/sync/watch', compact('email', 'calendar_id', 'endpoint'));
    }

    /**
     * Calendar Sync Stop
     *
     * @param $email,
     * @param $calendar_id,
     * @return \KWApi\Models\Response
     */
    public function calendarSyncStop($email, $calendar_id)
    {
        return $this->post('gcal/sync/stop', compact('email', 'calendar_id'));
    }

    /**
     * Google Event List
     *
     * @param $email
     * @param $calendar_id
     * @param null $time_max
     * @param null $time_min
     * @param null $page_token
     * @param null $sync_token
     * @return \KWApi\Models\Response
     */
    public function eventList($email, $calendar_id, $time_max = null, $time_min = null, $page_token = null, $sync_token = null)
    {
        return $this->get('google/event', [
            'email' => $email, 'calendarId' => $calendar_id, 'timeMax' => $time_max,
            'timeMin' => $time_min, 'pageToken' => $page_token, 'syncToken' => $sync_token]);
    }

    /**
     * Google Event Create
     *
     * @param $email
     * @param $summary
     * @param $start_date
     * @param $end_date
     * @param null $description
     * @param null $calendar_id
     * @param null $attendees
     * @return \KWApi\Models\Response
     */
    public function eventCreate($email, $summary, $start_date, $end_date, $description = null, $calendar_id = null, $attendees = null)
    {
        return $this->post('google/event', [
            'email' => $email, 'summary' => $summary, 'startDate' => $start_date, 'endDate' => $end_date,
            'description' => $description, 'attendees' => $attendees, 'calendarId' => $calendar_id
        ]);
    }

    /**
     * Google Event Detail
     *
     * @param $email
     * @param $event_id
     * @return \KWApi\Models\Response
     */
    public function eventDetail($email, $event_id)
    {
        return $this->get('google/event/'.$event_id, ['email' => $email]);
    }

    /**
     * Google Event Update
     *
     * @param $event_id
     * @param $email
     * @param null $summary
     * @param null $start_date
     * @param null $end_date
     * @param null $description
     * @param null $attendees
     * @param null $calendar_id
     * @return \KWApi\Models\Response
     */
    public function eventUpdate(
        $event_id,
        $email,
        $summary = null,
        $start_date = null,
        $end_date = null,
        $description = null,
        $attendees = null,
        $calendar_id = null
    ) {
        return $this->post('google/event/'.$event_id, [
            'email' =>  $email, 'summary' => $summary, 'startDate' => $start_date, 'endDate' => $end_date,
            'description' => $description, 'attendees' => $attendees, 'calendarId' => $calendar_id, '_method'=>'PUT'
        ]);
    }

    /**
     * Google Event Delete
     *
     * @param $event_id
     * @param $email
     * @param null $calendar_id
     * @return \KWApi\Models\Response
     */
    public function eventDelete($event_id, $email, $calendar_id = null)
    {
        return $this->post('google/event/' . $event_id, [
            'email' =>  $email, 'calendarId' => $calendar_id, '_method' => 'DELETE'
        ]);
    }
}

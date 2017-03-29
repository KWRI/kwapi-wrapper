<?php

/**
 * Created by PhpStorm.
 * User: abdulwahab
 * Date: 18/01/2017
 * Time: 11:03 AM
 */
namespace KWApi\Test;

class GoogleApiServiceTest extends TestCase
{
    protected $googleApi;

    protected function setUp()
    {
        parent::setUp();
        $this->googleApi = $this->app->googleApi();
    }

    public function testAccessToken()
    {
        $accessToken = [
            "access_token" => "ya29.Ci-gA72S2kvjOVBv9N0G09HZN6gmkp85MToOl5SvFSvbzjzQ9iBl3wAey5PnViPP_Q",
            "refresh_token" => "1/Goo-7l1Kd-DLnrA30K27pUggwvwbOGe99bXVtkRAtSE",
            "token_type" => "Bearer",
            "expires_in"=>3600,
            "created"=>time()
        ];
        $res = $this->googleApi->storeAccessToken('trm-kw@dev.kw.com', $accessToken);

        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testMails()
    {
        $res = $this->googleApi->mails('trm-kw@dev.kw.com');
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testMailDetail()
    {
        $mails = $this->googleApi->mails('trm-kw@dev.kw.com');

        $res = $this->googleApi->mailDetail( $mails->getBody()['messages']['response-1']['id'],'trm-kw@dev.kw.com');
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testSendMail()
    {
        $subject    =   'Test Mail';
        $fromName   =   'John Doe';
        $toName     =   'John Sena';
        $toEmail    =   'trm-kw@dev.kw.com';
        $mailBody   =   'Hello This is test mail. Thanks';

        $res = $this->googleApi->sendMail('trm-kw@dev.kw.com',$subject, $fromName, $toName, $toEmail, $mailBody);
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testCalendarList()
    {
        $res = $this->googleApi->calendarList('trm-kw@dev.kw.com');
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testCalendarSyncWatch()
    {
        $email       =   'trm-kw@dev.kw.com';
        $calendar_id =   'trm-kw@dev.kw.com';
        $endpoint    =   'https://google.com';

        //Until use real https domain, validated by google, watch will be unable to create.
        //Return will be response 400
        $res = $this->googleApi->calendarSyncWatch($email, $calendar_id, $endpoint);
//        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals(400, $res->getStatusCode());

        $this->googleApi->calendarSyncStop($email, $calendar_id);
    }

    public function testCalendarSyncStop()
    {
        $email       =   'trm-kw@dev.kw.com';
        $calendar_id =   'trm-kw@dev.kw.com';
        $endpoint    =   'https://test.latpat.com';

        $this->googleApi->calendarSyncWatch($email, $calendar_id, $endpoint);

        $res = $this->googleApi->calendarSyncStop($email, $calendar_id);
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testEventList()
    {
        $email       =   'trm-kw@dev.kw.com';
        $calendar_id =   'trm-kw@dev.kw.com';

        $res = $this->googleApi->eventList($email, $calendar_id);
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testEventCreate()
    {
        $email      =   'trm-kw@dev.kw.com';
        $calendar_id =   'trm-kw@dev.kw.com';
        $summary    =   'Test Event';
        $start_date =   '2017/02/23 12:00:00';
        $end_date   =   '2017/02/23 15:00:00';

        $res = $this->googleApi->eventCreate($email, $summary, $start_date, $end_date);
        $this->assertEquals(200, $res->getStatusCode());

        $this->googleApi->eventDelete($res->getBody()['event_id'], $email, $calendar_id);
    }

    public function testEventDetail()
    {
        $email       =   'trm-kw@dev.kw.com';
        $calendar_id =   'trm-kw@dev.kw.com';

        $events = $this->googleApi->eventList($email, $calendar_id);

        $res = $this->googleApi->eventDetail($email, $events->getBody()['events'][0]['id']);
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testEventUpdate()
    {
        $email       =   'trm-kw@dev.kw.com';
        $calendar_id =   'trm-kw@dev.kw.com';
        $summary    =   'Test Event';
        $start_date =   '2017/02/23 12:00:00';
        $end_date   =   '2017/02/23 15:00:00';

        $event = $this->googleApi->eventCreate($email, $summary, $start_date, $end_date);

        $summary   =    'Updated Event Test';

        $res = $this->googleApi->eventUpdate($event->getBody()['event_id'], $email, $summary);
        $this->assertEquals(200, $res->getStatusCode());

        $this->googleApi->eventDelete($event->getBody()['event_id'], $email, $calendar_id);
    }

    public function testEventDelete()
    {
        $email       =   'trm-kw@dev.kw.com';
        $calendar_id =   'trm-kw@dev.kw.com';
        $summary     =   'Test Event Delete';
        $start_date  =   '2017/02/23 12:00:00';
        $end_date    =   '2017/02/23 15:00:00';

        $event = $this->googleApi->eventCreate($email, $summary, $start_date, $end_date);

        $res = $this->googleApi->eventDelete($event->getBody()['event_id'], $email, $calendar_id);
        $this->assertEquals(200, $res->getStatusCode());
    }

    public function testMailsList()
    {
        $email       =   'trm-kw@dev.kw.com';
        $mails = $this->googleApi->mails($email);
        $this->assertEquals(200, $mails->getStatusCode());

        $messages = $mails->getBody()['messages'];
        $this->assertMailDetails(array_shift($messages)['id'], $email);
    }

    public function assertMailDetails($mailId, $email)
    {
        $mail = $this->googleApi->mailDetail($mailId, $email);
        $this->assertEquals(200, $mail->getStatusCode());
    }

}

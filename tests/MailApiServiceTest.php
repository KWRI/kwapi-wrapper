<?php

/**
 * Created by PhpStorm.
 * User: abdulwahab
 * Date: 18/01/2017
 * Time: 11:03 AM
 */
namespace KWApi\Test;

class MailApiServiceTest extends TestCase
{
    protected $googleApi;

    protected function setUp()
    {
        parent::setUp();
        $this->googleApi = $this->app->googleApi();
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

<?php

namespace KWApi\Traits;

trait MailApiTrait
{
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
}

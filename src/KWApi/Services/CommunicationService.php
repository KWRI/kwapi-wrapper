<?php

namespace KWApi\Services;

class CommunicationService extends AbstractService
{
    /**
     * Send Text Message
     *
     * @param string $phoneNumber   Valid phone number with country code. eg: +6285778275565
     * @param $message message      Message
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function sendText($phoneNumber, $message)
    {
        return $this->post('communications/send_text', compact('phoneNumber', 'message'));
    }
}
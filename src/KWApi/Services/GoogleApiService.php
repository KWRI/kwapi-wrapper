<?php
namespace KWApi\Services;

use KWApi\Traits\MailApiTrait;
use KWApi\Traits\CalendarApiTrait;

class GoogleApiService extends AbstractService
{
    use MailApiTrait;
    use CalendarApiTrait;

    /**
     * Backend connect
     * @param $redirect
     * @param array $payload
     * @return \KWApi\Models\Response
     */
    public function connect($redirect, $payload = [])
    {
        return $this->get('connect/google', ['redirect' => $redirect, 'payload' => $payload]);
    }

    /**
     * Backend Authenticate
     *
     * @param $accessToken
     * @param $redirect
     * @param array $payload
     * @return \KWApi\Models\Response
     */
    public function authenticate($accessToken, $redirect, $payload = [])
    {
        return $this->get('connect/authenticate', [
            'code' => $accessToken,
            'redirect' => $redirect,
            'payload' => $payload
        ]);
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
}

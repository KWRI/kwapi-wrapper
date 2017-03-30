<?php
/**
 * Created by PhpStorm.
 * User: abdulwahab
 * Date: 18/01/2017
 * Time: 10:30 AM
 */

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
}

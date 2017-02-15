<?php

namespace KWApi\Test;

use KWApi\Models\Credential;
use KWApi\KWApi;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * The API Endpoint URL to use while testing the application.
     *
     * @var string
     */
    protected $endPoint;

    protected $apiKey;

    protected $app;


    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        $config = require(__DIR__ . '/config.php');

        $this->apiKey = $config['apiKey'];
        $this->endPoint = $config['endPoint'];

        if (! $this->app) {
            $this->app = $this->createApplication();
        }
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUpOpenID()
    {
      $config = require(__DIR__ . '/config.php');
      $this->endPoint = $config['endPoint'];

      // Token data
      $tokenType = 'Bearer';
      $accessToken = md5(time());
      $refreshToken = md5(time()+1);
      $expiresIn = 24*3600;

      // User info  data
      $kwUid = '999';
      $email = 'pholenkadi17@gmail.com';
      $company = 'Refactory';
      $appName = 'KW-CRM';

      $token = new \KWApi\Models\OpenIDToken($tokenType, $accessToken, $refreshToken, $expiresIn);
      $userInfo = new \KWApi\Models\OpenIDUserInfo($kwUid, $email, $company, $appName);
      $credential = new \KWApi\Models\OpenIDCredential('pholenkadi', $token, $userInfo);
      $credential->setEndPoint($this->endPoint);

      $this->app = new \KWApi\KWApi($credential);
    }

    /**
     * Creates the application.
     *
     * @return \KWApi\KWApi
     */
    public function createApplication()
    {

        $credential = new Credential($this->apiKey);
        $credential->setEndPoint($this->endPoint);

        return new KWApi($credential);
    }

}

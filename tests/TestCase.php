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
    protected $endPoint = 'http://localhost:8001/v1/';

    protected $apiKey = 'URfBjVp2IWU6/wPojAQqtAm7+Iugt94TGbpJMvLjgeg=';

    protected $app;


    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        if (! $this->app) {
            $this->app = $this->createApplication();
        }
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
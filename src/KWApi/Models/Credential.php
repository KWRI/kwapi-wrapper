<?php

namespace KWApi\Models;

/**
 * Credential model
 */
class Credential
{
    private $apiKey;

    private $endPoint;


    /**
     * Construct Credential model
     *
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Set Override Endpoint value for API call
     * This method only used for testing purpose and only used for local environment
     * Makesure you dont use this method on production
     *
     * @todo Remove this on the future
     *
     * @param string $endPoint KW-Api Endpoint set null for not overriding Endpoint when calling API
     *
     * @return void
     */
    public function setEndPoint($endPoint)
    {
        $this->endPoint = $endPoint;
    }

    /**
     * Get Endpoint value
     *
     * @return string KW-Api Endpoint eg: http://localhost:8001/
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }


    /**
     * Get api key
     *
     * @return string Returns API Key
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
}

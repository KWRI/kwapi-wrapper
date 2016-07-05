<?php

namespace KWApi;

use GuzzleHttp\Client as HttpClient;
use KWApi\Models\Credential;


/**
 * KW Api Client library
 */
class KWApi {
    
    private $httpClient;

    private $credential;

    private $initiatedServices = [];

    /**
     * KWAPI Endpoint
     * @todo Set fixed KW-API endpoints here
     */
    private $endPoint = '';

    /**
     * Construct KWAPI Class
     * @param KWApi\Models\Credential $credential  API credential
     */
    public function __construct(Credential $credential)
    {
        // Ensure Endpoint from Credential object and override main endpoint when it not null
        if ($credential->getEndPoint() != null) {
            $this->endPoint = $credential->getEndPoint();
        }

        $this->httpClient = new HttpClient(['base_uri' => $this->endPoint]);
        $this->credential = $credential;

    }

    /**
     * Magic method to automatically construct Services object as singleton object
     *
     * @return mixed|KWApi\Services\AbstractService  Returns mixed value or AbstractService instance object
     *
     */
    public function __call($method, $params)
    {
        $className = 'KWApi\\Services\\'.ucfirst($method).'Service';
        
        if (array_key_exists($className, $this->initiatedServices)) {
            return $this->initiatedServices[$className];
        }

        if (class_exists($className)) {
            $this->initiatedServices[$className] = new $className($this->httpClient, $this->credential);

            return $this->initiatedServices[$className];
        }

        if (method_exists($this, $method)) {
            return call_user_func_array($method, $params);
        }

        throw new \Exception('Call to undefined method '  . KWApi::class . '::'. $method.'()');
    }


}
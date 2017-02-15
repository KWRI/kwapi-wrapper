<?php

namespace KWApi\Services;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;

use KWApi\Models\Credential;
use KWApi\Models\Response;

abstract class AbstractService {

    protected $httpClient;
    protected $credential;

    public function __construct($httpClient, $credential)
    {
        $this->httpClient = $httpClient;
        $this->credential = $credential;
    }

    /**
     * Send HTTP Request
     *
     * @param string $method GET|POST|PUT|DELETE Request method. Default GET
     * @param string $url Url to request
     * @param array $options Guzzle Http Client Request Options
     *
     * @return \KWApi\Models\Response Return response object
     */
    protected function send($method = 'GET', $url, $options = array())
    {

        $response = new Response();

        try {

            // Add apiKey to headers payload
            $options['headers']['apiKey'] = $this->credential->getApiKey();

            // Send API Payload
            $res = $this->httpClient->request($method, $url, $options);

            $response->setStatusCode($res->getStatusCode());
            $response->setBody(json_decode($res->getBody(), true));

        // Something wrong
        } catch (BadResponseException $e) {

            // Bad Response Error
            $res = $e->getResponse();

            $response->setStatusCode($res->getStatusCode());
            $response->setBody(json_decode($res->getBody(), true));
            $response->hasError(true);
            $response->setCause('BadRequest');


        } catch (ConnectException $e) {

            // Connection Error
            $response->hasError(true);
            $response->setCause('ConnectionError');
            if (isset($e->getHandlerContext()['error'])){
                // Example error: Message contains Failed to connect to localhost port 8001: Connection Refused
                $response->setBody($e->getHandlerContext()['error']);

            }

        }

        return $response;
    }

    /**
     * Send post request
     *
     * @param string $url  Url of API to call
     * @param array $params  Post form parameter
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function post($url, $params = array())
    {
        return $this->send('POST', $url, ['form_params' => $params]);
    }


    /**
     * Send post request
     *
     * @param string $url  Url of API to call
     * @param array $query  Post form parameter
     *
     * @return \KWApi\Models\Response Return response object
     */
    public function get($url, $query = array())
    {
        return $this->send('GET', $url, ['query' => $query]);
    }

}

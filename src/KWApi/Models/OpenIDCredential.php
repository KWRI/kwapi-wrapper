<?php
  namespace KWAPI\Models;

  use GuzzleHttp\Client as HttpClient;
  use GuzzleHttp\Exception\BadResponseException;
  use GuzzleHttp\Exception\ConnectException;


  /**
   *
   */
  class OpenIDCredential extends Credential
  {
    private $clientId;
    private $token;
    private $userInfo;
    private $httpClient;

    public function __construct($clientId, $token, $userInfo)
    {
      $this->clientId = $clientId;
      $this->token = $token;
      $this->userInfo = $userInfo;
    }


    public function getClientId($clientId)
    {
      return $this->clientId;
    }

    public function getApiKey()
    {
        $this->httpClient = new HttpClient(['base_uri' => $this->getEndPoint()]);

        $response = new Response();
        $method = 'POST';
        $url = 'api_users/openid';
        $options = ['form_params' => [
            'accessToken' => $this->token->getAccessToken(),
            'refreshToken' => $this->token->getRefreshToken(),
            'tokenType' => $this->token->getTokenType(),
            'expiresIn' => $this->token->getExpiresIn(),
            'kwUid' => $this->userInfo->getKWUID(),
            'email' => $this->userInfo->getEmail(),
            'company' => $this->userInfo->getCompany(),
            'application' => $this->userInfo->getAppName(),
            'provider' => $this->clientId
          ]];


        try {
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

        return $response->getStatusCode() == 200 ? $response->getBody()['apiKey'] : null;
    }
  }

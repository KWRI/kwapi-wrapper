<?php

  namespace KWApi\Models;

  /**
   *
   */
  class OpenIDToken
  {
    private $tokenType;
    private $accessToken;
    private $refreshToken;
    private $expiresIn;

    public function __construct($tokenType, $accessToken, $refreshToken, $expiresIn)
    {
      $this->tokenType = $tokenType;
      $this->accessToken = $accessToken;
      $this->refreshToken = $refreshToken;
      $this->expiresIn = $expiresIn;
    }

    public function setTokenType($tokenType)
    {
      $this->tokenType = $tokenType;
    }

    public function getTokenType()
    {
      return $this->tokenType;
    }

    public function setAccessToken($accessToken)
    {
      $this->accessToken = $accessToken;
    }

    public function getAccessToken()
    {
      return $this->accessToken;
    }

    public function setRefreshToken($refreshToken)
    {
      $this->refreshToken = $refreshToken;
    }

    public function getRefreshToken()
    {
      return $this->refreshToken;
    }

    public function setExpiresIn($expiresIn)
    {
      $this->expiresIn = $expiresIn;
    }

    public function getExpiresIn()
    {
      return $this->expiresIn;
    }
  }

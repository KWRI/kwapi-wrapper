<?php namespace KWApi\Models;

/**
 * Class OpenIDToken
 * @package KWApi\Models
 */
class OpenIDToken
{
    private $tokenType;
    private $accessToken;
    private $refreshToken;
    private $expiresIn;

    /**
     * OpenIDToken constructor.
     * @param $tokenType
     * @param $accessToken
     * @param $refreshToken
     * @param $expiresIn
     */
    public function __construct($tokenType, $accessToken, $refreshToken, $expiresIn)
    {
        $this->tokenType = $tokenType;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->expiresIn = $expiresIn;
    }

    /**
     * Set Token Type
     * @param $tokenType
     */
    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;
    }

    /**
     * Get Token Type
     * @return mixed
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * Set Access Token
     * @param $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Get Access Token
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set Refresh Token
     * @param $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * Get Refresh Token
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set Expires In
     * @param $expiresIn
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
    }

    /**
     * Get Expires In
     * @return mixed
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }
}

<?php

namespace KWApi\Models;

class Response
{

    private $isError = false;

    private $body;

    private $cause;

    private $statusCode;



    /**
     * Set response status code
     *
     * @param integer $code Status code
     *
     * @return void
     */
    public function setStatusCode($code)
    {
        $this->statusCode = $code;
    }

    /**
     * Set response body
     *
     * @param string|array $message Response body
     *
     * @return void
     */
    public function setBody($message)
    {
        $this->body = $message;
    }

    /**
     * Set response has error
     *
     * @param boolean $boolean
     *
     * @return void
     */
    public function hasError($boolean)
    {
        $this->isError = $boolean;
    }


    /**
     * Set error cause
     *
     * @param string $cause
     *
     * @return void
     */
    public function setCause($cause)
    {
        $this->cause = $cause;
    }

    /**
     * Response status code
     *
     * @return integer status Code
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Response body
     *
     * @return array|string  body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Check response has error
     *
     * @return boolean
     */
    public function isError()
    {
        return $this->isError;
    }

    /**
     * Get Error Cause
     *
     * @return string Return error cause
     */
    public function getCause()
    {
        return $this->cause;
    }

}
'use strict';
class Response {
    constructor() {
        this.isError = false
    }

    /**
    * Set response status code
    *
    * @param integer code Status code
    *
    * @return void
    */
    setStatusCode(code) {
        this.statusCode = code
    }

   /**
    * Set response body
    *
    * @param string|array message Response body
    *
    * @return void
    */
    setBody(message) {
        this.body = message
    }

   /**
    * Set response has error
    *
    * @param boolean boolean
    *
    * @return void
    */
    hasError(boolean) {
        this.isError = boolean
    }


   /**
    * Set error cause
    *
    * @param string cause
    *
    * @return void
    */
    setCause(cause) {
        this.cause = cause
    }

   /**
    * Response status code
    *
    * @return integer status Code
    */
    getStatusCode() {
        return this.statusCode
    }

   /**
    * Response body
    *
    * @return array|string  body
    */
    getBody() {
        return this.body
    }

   /**
    * Check response has error
    *
    * @return boolean
    */
    isError() {
        return this.isError
    }

   /**
    * Get Error Cause
    *
    * @return string Return error cause
    */
    getCause() {
        return this.cause
    }
}

module.exports = Response

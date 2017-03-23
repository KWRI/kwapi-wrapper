"use strict";
/**
 * Credential model
 */
class Credential {
    constructor(apiKey) {
        this.apiKey = apiKey || null;
        this.endPoint = null;
    }

    /**
     * Set Override Endpoint value for API call
     * This method only used for testing purpose and only used for local environment
     * Makesure you dont use this method on production
     * @todo Remove this on the future
     * @param string $endPoint KW-Api Endpoint set null for
     * not overriding Endpoint when calling API
     * @return void
     */

    setEndPoint(endPoint) {
        this.endPoint = endPoint;
    }

     /**
     * Get Endpoint value
     *
     * @return string KW-Api Endpoint eg: http://localhost:8001/
     */

    getEndPoint() {
        return this.endPoint;
    }

     /**
     * Get api key
     *
     * @return string Returns API Key
     */
    getApiKeyPromise() {
        return Promise.resolve(this.getApiKey());
    }

    getApiKey() {
        return this.apiKey;
    }

    setApiKey(apiKey) {
        this.apiKey = apiKey;
    }
}

module.exports = Credential;
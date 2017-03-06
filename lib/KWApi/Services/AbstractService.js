'use strict'

const axios = require('axios')
const querystring = require('qs')

class AbstractService {

    constructor(httpClient, credential, isTest = false) {
        this.httpClient = httpClient
        this.credential = credential
        this.isTest = isTest
    }

    /**
    * Send HTTP Request
    *
    * @param string method GET|POST|PUT|DELETE Request method. Default GET
    * @param string url Url to request
    * @param object options Options to be sent.
    *        It could contain query parameters, data, or headers.
    *        @see https://github.com/mzabriskie/axios#request-config
    *
    * @return response object
    */
    send(method, url, options) {
        return Promise.resolve(this.credential.getApiKey())
        .then(apiKey => (!apiKey ? this.credential.getApiKeyPromise() : this.apiKey))
        .then((apiKey) => {
            this.credential.setApiKey(apiKey)
            this.httpClient.defaults.headers.common = {
                apiKey,
            }
        })
        .then(() => this.httpClient.request(Object.assign({
            method,
            url,
        }, options)))
        .then(response => (this.isTest ? response : response.data))
    }

    /**
     * Send POST request
     *
     * @param string url  Url of API to call
     * @param array data  Post form parameter
     *
     * @return \KWApi\Models\Response Return response object
     */
    post(url, data) {
        return this.send('POST', url, {
            data: querystring.stringify(data),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        })
    }

    /**
     * Send GET request
     *
     * @param string url  Url of API to call
     * @param array query  Post form parameter
     *
     * @return response object
     */
    get(url, query) {
        return this.send('GET', url, {
            params: query,
        })
    }

    /**
     * Send PUT request
     *
     * @param string url  Url of API to call
     * @param array data  Post form parameter
     *
     * @return response object
     */
    put(url, data) {
        return this.send('PUT', url, {
            data: querystring.stringify(data),
        })
    }

    /**
     * Send PUT request
     *
     * @param string url  Url of API to call
     * @param array data  Post form parameter
     *
     * @return response object
     */
    delete(url, params) {
        return this.send('DELETE', url, params)
    }
}

module.exports = AbstractService

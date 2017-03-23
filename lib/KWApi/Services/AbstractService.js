"use strict"

const axios = require("axios");
const querystring = require("qs");

class AbstractService {

    constructor(httpClient, credential, isTest) {
        isTest = !!isTest ? isTest : false;
        this.httpClient = httpClient;
        this.credential = credential;
        this.isTest = isTest;
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
                .then((apiKey) => {
                    this.credential.setApiKey(apiKey)
                    this.httpClient.defaults.headers.common = {
                        apiKey,
                    };
                })
                .then(() => this.httpClient.request(Object.assign({
                    method,
                    url,
                }, options)))
                .then(response => response);
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
        return this.send("POST", url, {
            data: querystring.stringify(data),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
        });
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
        const qr = !!query ? query : {};
        return this.send("GET", url, {
            params: qr,
        });
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
        return this.send("PUT", url, {
            data: querystring.stringify(data),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
        });
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
        return this.send("DELETE", url, params);
    }
}

module.exports = AbstractService;

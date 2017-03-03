const axios = require('axios')
const querystring = require('qs')

class AbstractService {

    constructor(httpClient, credential) {
        this.httpClient = httpClient
        this.credential = credential
    }

    /**
    * Send HTTP Request
    *
    * @param string method GET|POST|PUT|DELETE Request method. Default GET
    * @param string url Url to request
    *
    * @return \KWApi\Models\Response Return response object
    */
    send(method, url, options) {
        const httpVerb = method.toLowerCase()

        return Promise.resolve(this.credential.getApiKey()).then((apiKey) => {
            if (typeof apiKey === 'undefined') {
                return this.credential.getApiKeyPromise()
            }

            return apiKey
        })
        .then((apiKey) => {
            this.credential.setApiKey(apiKey)

            if (typeof this.httpClient === 'undefined') {
                this.httpClient = axios.create({
                    baseURL: this.credential.getEndPoint(),
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded', apiKey },
                })
            }
        })
        .then(() => this.httpClient[httpVerb](url, options))
        .then(response => response.data)
    }

    /**
     * Send post request
     *
     * @param string url  Url of API to call
     * @param array params  Post form parameter
     *
     * @return \KWApi\Models\Response Return response object
     */
    post(url, params) {
        // if (params.agents) {
        //     return this.send('POST', url, params)
        // }
        // console.log('heiiii', params)
        return this.send('POST', url, querystring.stringify(params))
    }

    /**
     * Send post request
     *
     * @param string url  Url of API to call
     * @param array query  Post form parameter
     *
     * @return \KWApi\Models\Response Return response object
     */
    get(url, query) {
        return this.send('GET', url, {
            params: query,
        })
    }

    put(url, params) {
        return this.send('PUT', url, querystring.stringify(params))
    }
}

module.exports = AbstractService

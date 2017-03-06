'use strict';
const axios = require('axios')
const Credential = require('./Credential')
const querystring = require('querystring')

class OpenIDCredential extends Credential {
    constructor(clientId, token, userInfo) {
        super()
        this.clientId = clientId
        this.token = token
        this.userInfo = userInfo
    }

    getClientId() {
        return this.clientId
    }

    getApiKey() {
        this.httpClient = axios.create({
            baseURL: this.endPoint,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        })

        const url = 'api_users/openid'
        const method = 'post'

        const options = {
            accessToken: this.token.getAccessToken(),
            refreshToken: this.token.getrefreshToken(),
            tokenType: this.token.getTokenType(),
            expiresIn: this.token.getExpiresIn(),
            kwUid: this.userInfo.getEmail(),
            email: this.userInfo.getEmail(),
            company: this.userInfo.getCompany(),
            application: this.userInfo.getAppName(),
            provider: this.clientId,
        }

        return this.httpClient[method](url, querystring.stringify(options)).then((response) => {
            if (response.status === 200) {
                const apiKey = response.data.apiKey
                this.apiKey = apiKey

                return apiKey
            }
        })
    }
}

module.exports = OpenIDCredential

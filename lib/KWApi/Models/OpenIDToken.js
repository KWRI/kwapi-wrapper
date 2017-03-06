'use strict';
class OpenIDToken {
    constructor(tokenType, accessToken, refreshToken, expiresIn) {
        this.tokenType = tokenType
        this.accessToken = accessToken
        this.refreshToken = refreshToken
        this.expiresIn = expiresIn
    }

    setTokenType(tokenType) {
        this.tokenType = tokenType
    }

    getTokenType() {
        return this.tokenType
    }

    setAccessToken(accessToken) {
        this.accessToken = accessToken
    }

    getAccessToken() {
        return this.accessToken
    }

    setRefreshToken(refreshToken) {
        this.refreshToken = refreshToken
    }

    getrefreshToken() {
        return this.refreshToken
    }

    setExpiresIn(expiresIn) {
        this.expiresIn = expiresIn
    }

    getExpiresIn() {
        return this.expiresIn
    }
}

module.exports = OpenIDToken

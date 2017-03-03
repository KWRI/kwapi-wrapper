/* global Moxios, apiKey, endPoint,email, company, appName */
const BasePath = '../../../../src/'
/* eslint-disable */
const Credential = require(BasePath + 'KWApi/Models/Credential')

const KWAPI = require(BasePath + 'KWApi/')
/* eslint-enable */

const credential = new Credential(apiKey)

const assert = require('assert')

describe('KWApi', () => {
    before(() => {
        // Moxios.install()
    })

    after(() => {
        // Moxios.uninstall()
    })

    credential.setEndPoint(endPoint)
    const KwApi = new KWAPI(credential)

    describe('setEndPoint()', () => {
        xit('Should set endPoint', () => {
            KwApi.getEndPoint().should.equals(endPoint)
        })
    })

    describe('getApiKey()', () => {
        xit('Should have an apiKey', () => {
            assert.equal(apiKey, KwApi.credential.apiKey)
        })
    })
})

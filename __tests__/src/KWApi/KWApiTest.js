'use strict';
/* global Moxios, apiKey, endPoint,email, company, appName */
const BasePath = '../../../lib/'
const chai = require('chai')
const qs = require('qs')
const MockAdapter = require('axios-mock-adapter')

const expect = chai.expect

/* eslint-disable */
const Credential = require(BasePath + 'KWApi/Models/Credential')

const KWAPI = require(BasePath + 'KWApi/')
/* eslint-enable */

const credential = new Credential(apiKey)

describe('KWAPI Test', () => {
    credential.setEndPoint(endPoint)
    const apiUser = new KWAPI(credential, {
        afterHttpClientSet: (client) => {
            const mock = new MockAdapter(client)
            mock.onPost('api_users').reply(200, {
                id: 1,
            })
        },
    })
    apiUser.setIsTest(true)

    it('It should give a proper object', () => {
        expect(apiUser.ApiUser()).to.be.a('object')
    })
    it('should send proper request', () => {
        const params = {
            apiKey: `${new Date().getTime()}abc123`,
            email: 'pholenkadi@gmail.com',
            company: 'Refactory-ID',
            application: 'KW-CRM',
        }
        apiUser.ApiUser()
            .create(params.apiKey, params.email, params.company, params.application)
            .then((response) => {
                const data = qs.parse(response.config.data)
                expect(response.status).to.be.eq(200)
                expect(response.config.method.toLowerCase()).to.be.eq('POST'.toLowerCase())
                expect(data.apiKey).to.be.eq(params.apiKey)
                expect(data.email).to.be.eq(params.email)
                expect(data.company).to.be.eq(params.company)
                expect(data.application).to.be.eq(params.application)
            }).catch(err => console.error(err))
    })
})

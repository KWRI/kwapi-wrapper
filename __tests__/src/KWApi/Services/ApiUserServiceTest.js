'use strict';
/* global Moxios, apiKey, endPoint,email, company, appName */
const BasePath = '../../../../lib/'

/* eslint-disable */
const Credential = require(BasePath + 'KWApi/Models/Credential')

const KWAPI = require(BasePath + 'KWApi/')
/* eslint-enable */

const credential = new Credential(apiKey)

const assert = require('assert')

const testApiKey = `${Math.floor(100000000 + (Math.random() * 900000000))}abc123`

describe('ApiUserService', () => {

    credential.setEndPoint(endPoint)
    const KwApi = new KWAPI(credential)

    describe('testRead()', () => {
        xit('Should read an id from /api_users', (done) => {
            const resultObj = {
                id: 1,
                apiKey: 'abc123',
                company: 'KWRI',
                application: 'alpha',
                email: 'josh.team@kw.com',
            }
            KwApi.ApiUser().read(resultObj.id)
                .then((response) => {
                    response.id.should.equal(resultObj.id)
                    response.apiKey.should.equal(resultObj.apiKey)
                    response.company.should.equal(resultObj.company)
                    response.application.should.equal(resultObj.application)
                    response.email.should.equal(resultObj.email)
                    done()
                }).catch(err => done(err))
        })
    })

    describe('testCreate()', () => {
        xit('Should create a new ApiUser', (done) => {
            const resultObj = {
                company: 'Refactory',
                application: 'KW-CRM',
                email: 'pholenkadi17@gmail.com',
                isActive: 1,
            }

            KwApi.ApiUser().create(testApiKey, email, company, appName)
                .then((response) => {
                    response.apiKey.should.equal(testApiKey)
                    response.company.should.equal(resultObj.company)
                    response.application.should.equal(resultObj.application)
                    response.email.should.equal(resultObj.email)
                    response.isActive.should.equal(resultObj.isActive)
                    response.updated_at.should.exist
                    response.created_at.should.exist
                    done()
                })
                .catch(err => done(err))
        })
    })

    describe('testDelete()', () => {
        xit('Could delete an ApiUser', (done) => {
            let createId
            KwApi.ApiUser().create(testApiKey, email, company, appName)
                .then((response) => {
                    createId = response.id
                    done()
                }).catch(err => done(err))

            KwApi.ApiUser().delete(createId)
                .then((response) => {
                    response.id.should.equal(createId)
                    done()
                })
                .catch(err => done(err))
        })
    })

    describe('testBrowseApiUserList()', () => {
        xit('Could browse the existing ApiUser', (done) => {
            KwApi.ApiUser().browse(1)
                .then((response) => {
                    assert.equal(typeof response.data, 'object')
                    done()
                }).catch(err => done(err))
        })
    })

    describe('testUpdate()', () => {
        xit('Should update the ApiUser info', (done) => {
            const createdId = 618
            const newEmail = `new${email}`
            KwApi.ApiUser().update(createdId, testApiKey, newEmail, company, appName)
                .then((response) => {
                    response.id.should.equal(createdId)
                    response.apiKey.should.equal(testApiKey)
                    response.company.should.equal(company)
                    response.application.should.equal(appName)
                    response.email.should.equal(newEmail)
                    response.isActive.should.equal(1)
                    response.updated_at.should.to.exist
                    response.created_at.should.to.exist
                    done()
                }).catch(err => done(err))
        })
    })
})

'use strict';
/* global Moxios, apiKey, endPoint,email, company, appName */
const BasePath = '../../../../lib/'
const md5 = require('blueimp-md5')

// Token data
const tokenType = 'Bearer'
const accessToken = md5(new Date())
const refreshToken = md5(Math.floor(Date.now() / 1000) + 1)
const expiresIn = 24 * 3600

/* eslint-disable */

// setUpOpenID
const OpenIDToken = require(BasePath + 'KWApi/Models/OpenIDToken')
const OpenIDUserInfo = require(BasePath + 'KWApi/Models/OpenIDUserInfo')
const OpenIDCredential = require(BasePath + 'KWApi/Models/OpenIDCredential')
const clientId = "98jjhury866"

const KWAPI = require(BasePath + 'KWApi/')

const token = new OpenIDToken(tokenType, accessToken, refreshToken, expiresIn)
const userInfo = new OpenIDUserInfo(kwUid, email, company, appName)
const credential = new OpenIDCredential(clientId, token, userInfo)

/* eslint-enable */

describe('LeadRoutingTest', () => {

    credential.setEndPoint(endPoint)

    const KwApi = new KWAPI(credential)

    describe('testList()', () => {
        it('Should get list of IDs', (done) => {
            let createdId
            KwApi.LeadRouting().lists()
                .then((result) => {
                    result.status.should.equal(200)
                    result.config.method.should.equal('GET')
                    result.data.per_page.should.above(0)
                    result.data.current_page.should.be.a('number')
                    done()
                })
                .catch((err) => { done(err) })
        })
    })

    describe('testAll()', () => {
        it('Should Display all list include non api key users list', (done) => {
            KwApi.LeadRouting().all().then((result) => {
                result.status.should.equal(200)
                result.config.method.should.equal('GET')
                result.data.total.should.be.a('number')
                result.data.data.should.instanceOf(Array)
                done()
            }).catch(err => done(err))
        })
    })

    describe('testCreateList()', () => {
        it('Could Create a List', (done) => {
            const data = {
                name: 'Test create list name',
                router: 'RoundRobin',
                hash: 'hashkey',
            }
            let createdId
            KwApi.LeadRouting().createList(data.name, data.router, data.hash).then((result) => {
                result.status.should.equal(200)
                result.config.method.should.equal('POST')
                result.data.hash.should.ownProperty('length')
                result.data.should.have.any.keys('id')
                result.data.should.have.any.keys('hash')
                result.data.should.have.any.keys('name')
                createdId = result.data.id
            })
            .then(() => KwApi.LeadRouting().removeList(createdId))
            .then(() => { done() })
            .catch(err => done(err))
        })
    })

    describe('testReadList()', () => {
        const data = {
            name: 'Test create list name',
            router: 'RoundRobin',
            hash: 'hashkey',
        }
        it('Should Display a List', (done) => {
            let createdId
            KwApi.LeadRouting().createList(data.name, data.router, data.hash)
            .then((result) => { createdId = result.data.id })
            .then(() => KwApi.LeadRouting().readList(createdId))
            .then((result) => {
                result.status.should.equal(200)
                result.config.method.should.equal('GET')
                result.data.hash.should.ownProperty('length')
                result.data.should.have.any.keys('id')
                result.data.should.have.any.keys('hash')
                result.data.should.have.any.keys('name')
            })
            .then(() => KwApi.LeadRouting().removeList(createdId))
            .then(() => { done() })
            .catch(err => done(err))
        })
    })

    describe('testUpdateList()', () => {
        it('Could Update a List', (done) => {
            const data = {
                name: 'Test update list',
                router: 'RoundRobin',
                hash: 'hashkey',
            }
            const newData = {
                name: 'Test update list new name',
                router: 'RoundRobin',
                hash: 'newsh',
            }
            let createdId
            KwApi.LeadRouting().createList(data.name, data.router, data.hash)
                .then((result) => { createdId = result.data.id })
                .then(() => KwApi.LeadRouting()
                                .updateList(createdId, newData.name, newData.router, newData.hash))
                .then((result) => {
                    result.status.should.equal(200)
                    result.config.method.should.equal('PUT')
                    result.data.id.should.equal(createdId)
                    result.data.api_user_id.should.be.a('number')
                    result.data.name.should.be.a('string')
                    result.data.hash.should.be.a('string')
                    result.data.router.should.be.a('string')
                })
                .then(() => KwApi.LeadRouting().removeList(createdId))
                .then(() => { done() })
                .catch(err => done(err))
        })
    })

    describe('testCreateAgent()', () => {
        it('Could Create an Agent on specific list', (done) => {
            const data = {
                name: 'Test create agent',
                router: 'RoundRobin',
                hash: 'hashkey',
            }

            const agentName = 'Test new agent name'
            const agentId = `test_new_agent_id ${new Date()}`
            const email = '2light.hidayah@gmail.com'

            let createdId
            KwApi.LeadRouting().createList(data.name, data.router, data.hash)
                .then((result) => { createdId = result.data.id })
                .then(() => KwApi.LeadRouting()
                            .createAgent(createdId, agentName, agentId, email))
                .then((result) => {
                    result.status.should.equal(200)
                    result.config.method.should.equal('POST')
                    result.data.kw_uid.should.be.a('string')
                    result.data.first_name.should.be.a('string')
                    result.data.last_name.should.be.a('string')
                    result.data.email.should.be.a('string')
                    result.data.active.should.equal('true')
                })
                .then(() => KwApi.LeadRouting().removeList(createdId))
                .then(() => { done() })
                .catch(err => done(err))
        })
    })

    describe('testCreateAgents()', () => {
        it('Could Bulk create multiple Agents on specific list', (done) => {
            const data = {
                name: 'Test create agents',
                router: 'RoundRobin',
                hash: 'hashkey',
            }

            const rows = [
                { name: 'Test agent 1',
                    agent_id: `test_agent_1_id ${new Date()}`,
                    email: '2light.hidayah@gmail.com' },
                { name: 'Test agent 2',
                    agent_id: `test_agent_2_id ${new Date()}`,
                    email: 'nurcahyo.hidayah@gmail.com' },
            ]

            let createdId
            KwApi.LeadRouting().createList(data.name, data.router, data.hash)
                .then((result) => { createdId = result.data.id })
                .then(() => KwApi.LeadRouting()
                            .createAgents(createdId, rows))
                .then((result) => {
                    result.status.should.equal(200)
                    result.config.method.should.equal('POST')
                    result.data[0].id.should.be.a('number')
                    result.data[0].email.should.have.string('@')
                    result.data[0].first_name.should.be.a('string')
                    result.data[0].last_name.should.be.a('string')
                    result.data[0].active.should.equal('true')
                    result.data[0].kw_uid.should.be.a('string')
                })
                .then(() => KwApi.LeadRouting().removeList(createdId))
                .then(() => { done() })
                .catch(err => done(err))
        })
    })

    describe('testAssignLead()', () => {
        xit('Could Assign an agent a lead', (done) => {
            const data = {
                name: 'Test assign lead',
                router: 'RoundRobin',
                hash: 'hashkey',
            }

            const rows = [
                { name: 'Test agent 1',
                    agent_id: `test_agent_1_id ${new Date()}`,
                    email: '2light.hidayah@gmail.com' },
                { name: 'Test agent 2',
                    agent_id: `test_agent_2_id ${new Date()}`,
                    email: 'nurcahyo.hidayah@gmail.com' },
            ]

            let createdId
            KwApi.LeadRouting().createList(data.name, data.router, data.hash)
                .then((result) => { createdId = result.data.id })
                .then(() => KwApi.LeadRouting().createAgents(createdId, rows))
                .then(() => KwApi.LeadRouting().assignLead(createdId, 'Test_Lead_info_1', 1))
                .then((result) => {
                    result.status.should.equal(200)
                    result.config.method.should.equal('POST')
                })
                .then(() => KwApi.LeadRouting().removeList(createdId))
                .then(() => { done() })
                .catch(err => done(err))
        })
    })
})
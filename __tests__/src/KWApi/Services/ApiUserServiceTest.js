"use strict";
/* global Moxios, apiKey, endPoint,email, company, appName */
const BasePath = "../../../../lib/";

/* eslint-disable */
const Credential = require(BasePath + "KWApi/Models/Credential");

const KWAPI = require(BasePath + "KWApi/");
/* eslint-enable */

const credential = new Credential(apiKey);

const testApiKey = `${Math.floor(100000000 + (Math.random() * 900000000))}abc123`;

describe("ApiUserService", () => {

    credential.setEndPoint(endPoint);
    const KwApi = new KWAPI(credential);

    describe("testRead()", () => {
        it("Should read an id from /api_users", (done) => {
            const resultObj = {
                id: 1,
                apiKey: "abc123",
                company: "KWRI",
                application: "alpha",
                email: "josh.team@kw.com",
            };
            KwApi.ApiUser().read(resultObj.id)
                .then((response) => {
                    response.status.should.equal(200);
                    response.config.method.should.equal("GET");
                    response.data.id.should.equal(resultObj.id);
                    response.data.apiKey.should.equal(resultObj.apiKey);
                    response.data.company.should.equal(resultObj.company);
                    response.data.application.should.equal(resultObj.application);
                    response.data.email.should.equal(resultObj.email);
                    done();
                }).catch(err => done(err));
        });
    });

    describe("testCreate()", () => {
        it("Should create a new ApiUser", (done) => {
            const resultObj = {
                company: "Refactory",
                application: "KW-CRM",
                email: "pholenkadi17@gmail.com",
                isActive: 1,
            };
            let createId;
            KwApi.ApiUser().create(testApiKey, email, company, appName)
                .then((response) => {
                    createId = response.data.id;
                    response.config.method.should.equal("POST");
                    response.data.apiKey.should.equal(testApiKey);
                    response.data.company.should.equal(resultObj.company);
                    response.data.application.should.equal(resultObj.application);
                    response.data.email.should.equal(resultObj.email);
                    response.data.isActive.should.equal(resultObj.isActive);
                })
                .then(() => KwApi.ApiUser().delete(createId))
                .then(() => { done(); })
                .catch(err => done(err));
        });
    });

    describe("testDelete()", () => {
        it("Could delete an ApiUser", (done) => {
            let createdId;
            KwApi.ApiUser().create(testApiKey, email, company, appName)
                .then((response) => { createdId = response.data.id; })
                .then(() => KwApi.ApiUser().delete(createdId))
                .then((response) => {
                    response.config.method.should.equal("DELETE");
                    response.data.id.should.equal(createdId);
                })
                .then(() => { done(); })
                .catch(err => done(err));
        });
    });

    describe("testBrowseApiUserList()", () => {
        it("Could browse the existing ApiUser", (done) => {
            KwApi.ApiUser().browse(1)
                .then((response) => {
                    response.status.should.equal(200);
                    response.config.method.should.equal("GET");
                    response.data.should.be.a("object");
                    done();
                }).catch(err => done(err));
        });
    });

    describe("testUpdate()", () => {
        it("Should update the ApiUser info", (done) => {
            let createdId;
            const newEmail = `new${email}`;
            KwApi.ApiUser().create(testApiKey, email, company, appName)
                .then((response) => { createdId = response.data.id; })
                .then(() => KwApi.ApiUser()
                                .update(createdId, testApiKey, newEmail, company, appName))
                .then((response) => {
                    response.status.should.equal(200);
                    response.data.id.should.equal(createdId);
                    response.data.apiKey.should.equal(testApiKey);
                    response.data.company.should.equal(company);
                    response.data.application.should.equal(appName);
                    response.data.email.should.equal(newEmail);
                    response.data.isActive.should.equal(1);
                })
                .then(() => KwApi.ApiUser().delete(createdId))
                .then(() => { done(); })
                .catch(err => done(err));
        });
    });
});
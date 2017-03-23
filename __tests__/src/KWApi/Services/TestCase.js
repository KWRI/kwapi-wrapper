"use strict";
/* global apiKey, endPoint*/
const BasePath = "../../../../lib/";
/* eslint-disable */
const Credential = require(BasePath + "KWApi/Models/Credential");

const KWAPI = require(BasePath + "KWApi/");
/* eslint-enable */

const credential = new Credential(apiKey);

const assert = require("assert");

describe("KWApi", () => {

    credential.setEndPoint(endPoint);
    const KwApi = new KWAPI(credential);

    describe("setEndPoint()", () => {
        it("Should set endPoint", () => {
            KwApi.getEndPoint().should.equals(endPoint);
        });
    });

    describe("getApiKey()", () => {
        it("Should have an apiKey", () => {
            assert.equal(apiKey, KwApi.credential.apiKey);
        });
    });
});

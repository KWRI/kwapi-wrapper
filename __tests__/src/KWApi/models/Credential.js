"use strict";
const BasePath = "../../../../lib/";
const chai = require("chai");
const Credential = require(BasePath + "KWApi/Models/Credential");

const expect = chai.expect;
describe("Credential testing", function() {
    it("should give the same apiKey", function(){
        const apiKey = `${new Date().getTime()}abc123`;
        const credential = new Credential(apiKey);
        expect(credential.getApiKey()).to.be.eq(apiKey);
    });
    it("should give me null", function(){
        const credential = new Credential();
        expect(credential.getApiKey()).to.be.eq(null);
    });
});
/* eslint-disable */

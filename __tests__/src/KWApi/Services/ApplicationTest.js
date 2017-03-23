"use strict";
/* global Moxios, apiKey, endPoint,email, company, appName */
const BasePath = "../../../../lib/";

/* eslint-disable */
const Credential = require(BasePath + "KWApi/Models/Credential");

const KWAPI = require(BasePath + "KWApi/");
/* eslint-enable */

const credential = new Credential(apiKey);

describe("Application Test", () => {
    credential.setEndPoint(endPoint);
    const apiUser = new KWAPI(credential).ApiUser();

    it("It should Success Construct Singleton Service", () => {
        apiUser.credential.apiKey.should
            .equal(new KWAPI(credential).ApiUser().credential.apiKey);
        apiUser.credential.endPoint.should
            .equal(new KWAPI(credential).ApiUser().credential.endPoint);
    });
});

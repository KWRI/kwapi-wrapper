"use strict";

const BasePath = "../../../../lib/";
 
const Credential = require(BasePath + "KWApi/Models/Credential");

const KWAPI = require(BasePath + "KWApi/");

const credential = new Credential(global.apiKey);

const assert = require("assert");

describe("EventService", () => {
    credential.setEndPoint(global.endPoint);
    const KwApi = new KWAPI(credential);

    describe("testRegister()", () => {
        xit("Should register an Event data", (done) => {
            const requestObject = {
                object: "lead",
                action: "delete",
                version: 21,
                jasonSchema: require("test.json"),
            };

            KwApi.Event().register(requestObject.object,
                                    requestObject.action,
                                    requestObject.version,
                                    requestObject.jasonSchema)
                .then((response) => {
                    response.status.should.equal(200);
                    response.config.method.should.equal("POST");
                    response.data.object.should.equal(requestObject.object);
                    response.data.action.should.equal(requestObject.action);
                    response.data.version.should.equal(requestObject.version.toString());
                    done();
                }).catch(err => done(err));
        });
    });

    describe("testSubscribe()", () => {
        xit("should adding event in subscribe", (done) => {
            const requestObject = {
                object: "lead",
                action: "delete",
                version: 21,
                endPoint: "übung_macht_meister.com",
            };

            KwApi.Event().subscribe(requestObject.object,
                                    requestObject.action,
                                    requestObject.version,
                                    requestObject.endPoint)
                .then((response) => {
                    response.status.should.equal(200);
                    response.config.method.should.equal("POST");
                    response.data.object.should.equal(requestObject.object);
                    response.data.action.should.equal(requestObject.action);
                    response.data.version.should.equal(requestObject.version.toString());
                    response.data.endPoint.should.equal(requestObject.endPoint);
                    done();
                }).catch(err => done(err));
        });
    });

    /**
     * pending 
     */
    describe("testAdd()", () => {
        xit("should Add event message that need to dispatch to subscriber services or applications.", (done) => {
            const requestObject = {
                object: "user",
                action: "update",
                version: 37,
                event: "this is just for test",
            };

            KwApi.Event().add(requestObject.object, requestObject.action, requestObject.version, requestObject.event)
                 .then((response) => {
                    //  response.status.should.equal(200)
                    //  response.config.method.should.equal("POST")
                    //  response.data.object.should.equal(requestObject.object)
                    //  response.data.action.should.equal(requestObject.action)
                    //  response.data.version.should.equal(requestObject.version.toString())
                    //  response.data.event.should.equal(requestObject.event)
                     done();
                 }).catch(err => done(err));
        });
    });

    describe("testBrowse()", () => {
        xit("could browse the exiting Events", (done) => {
            KwApi.Event().browse(1)
                .then((response) => {
                    response.status.should.equal(200);
                    response.config.method.should.equal("GET");
                    assert.equal(typeof response.data, "object");
                    done();
                }).catch(err => done(err));
        });
    });

    describe("testRead()", () => {
        xit("Should read an id from /events", (done) => {
            const requestObject = { id: 19 };

            KwApi.Event().read(requestObject.id)
                .then((response) => {
                    response.status.should.equal(200);
                    response.config.method.should.equal("GET");
                    response.data.id.should.equal(requestObject.id);
                    done();
                }).catch(err => done(err));
        });
    });

    describe("testBrowseSubscriber()", () => {
        xit("Should read subscribe id based on event id", (done) => {
            const requestObject = { id: 32 };

            KwApi.Event().browseSubscriber(requestObject.id)
                .then((response) => {
                    response.status.should.equal(200);
                    response.config.method.should.equal("GET");
                    response.data[0].event_id.should.equal(requestObject.id);
                    done();
                }).catch(err => done(err));
        });
    });

    /**
    *testUpdate temporarily cannot be used until edit functionality in EVENT KW-API have been fixed
    */
    describe("testUpdate()", () => {
        xit("Should update the Event", (done) => {
            const requestObject = {
                id: 32,
                object: "interaction",
                action: "create",
                version: 8,
                jsonSchema: {"$schema":"http://json-schema.org/draft-04/schema#","type":"object","properties":{"name":{"type":"string"},"object":{"type":"string"},"action":{"type":"string"},"createdAt":{"type":"string"}},"required":["name","object","action","createdAt"]}
            };
            KwApi.Event().update(requestObject.id,
                                    requestObject.object,
                                    requestObject.action,
                                    requestObject.version,
                                    requestObject.jasonSchema)
                .then((response) => {
                    response.id.should.equal(requestObject.id);
                    response.object.should.equal(requestObject.object);
                    response.action.should.equal(requestObject.action);
                    response.version.should.equal(requestObject.version);
                    done();
                }).catch(err => done(err));
        });
    });

    describe("testUnubscribe()", () => {
        xit("should unsubscribing event data ", (done) => {
            const requestObject = {
                object: "lead",
                action: "delete",
                version: 21,
            };

            KwApi.Event().unsubscribe(requestObject.object,
                                        requestObject.action,
                                        requestObject.version)
                .then((response) => {
                    response.status.should.equal(200);
                    response.config.method.should.equal("POST");
                    response.data.object.should.equal(requestObject.object);
                    response.data.action.should.equal(requestObject.action);
                    response.data.version.should.equal(requestObject.version.toString());
                    done();
                }).catch(err => done(err));
        });
    });

    describe("testDelete()", () => {
        xit("Could delete an Event by id", (done) => {
            const requestObject = { id: 32 };
            KwApi.Event().delete(requestObject.id)
                .then((response) => {
                    response.status.should.equal(200);
                    response.config.method.should.equal("DELETE");
                    response.data.id.should.equal(requestObject.id);
                    done();
                })
                .catch(err => done(err));
        });
    });
});

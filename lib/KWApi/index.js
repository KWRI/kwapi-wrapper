'use strict';

const axios = require('axios');

// Register all services files in the folder Services
const registeredServices = {
    'Abstract': require(`./Services/AbstractService`),
    'ApiUser': require(`./Services/ApiUserService`),
    'Communication': require(`./Services/CommunicationService`),
    'Demographic': require(`./Services/DemographicService`),
    'LeadRouting': require(`./Services/LeadRoutingService`),
    'People': require(`./Services/PeopleService`),
    'Event': require(`./Services/EventService`)
}

class KWApi {
    constructor(credential, options) {
        this.credential = credential
        this.endPoint = ''
        // flag to mark that this class will be used in testing environment
        if(typeof options == 'undefined') {
            options = {}
        }
        this.isTest = false;
        this.initiatedServices = {}

        if (!!this.credential.getEndPoint()) {
            this.endPoint = this.credential.getEndPoint()
        }
        this.httpClient = axios.create({
            baseURL: this.endPoint,
        });

        /**
         * construct Services object as singleton object
         */
        Object.keys(registeredServices).map(service => {
            this[service] = () => {
                if(Object.keys(this.initiatedServices).indexOf(service)<0){
                    const Service = registeredServices[service];
                    this.initiatedServices[service] = new Service(this.httpClient, this.credential, this.isTest)
                }
                return this.initiatedServices[service] || null;
            }
        });
        Object.keys(options).map(method => {
            if(!!this[method]){
                this[method](options[method]);
            }
        });
    }

    getEndPoint() {
        return this.endPoint
    }

    afterHttpClientSet(callback) {
        callback(this.httpClient);
    }
    setIsTest(isTest) {
        this.isTest = isTest;
        return this;
    }
}

module.exports = KWApi

'use strict';

const BasePath = '../../../../lib/'

const Credential = require(BasePath + 'KWApi/Models/Credential')

const KWAPI = require(BasePath + 'KWApi/')

const credential = new Credential(apiKey)

describe('DemographicService', () => {
    credential.setEndPoint(endPoint)
    const KwApi = new KWAPI(credential)

    /**
     *test for getDemographics() 
     *the data inputed as parameter for test is d_email 
     *checking response body for EmailAddr that have same data value with equest body( d_email ) if the request true
     */
    describe('testGetDemographics', () => {
        it('it should get demographics information for lookup data', (done) => {
            const data = {
                d_email: 'bart@fullcontact.com'
            }

            KwApi.Demographic().getDemographics(data)
                .then((response) => {
                    response.status.should.equal(200)
                    response.config.method.should.equal('GET')
                    response.data.datafinder['input-query'].EmailAddr.should.equal(data.d_email)
                    done()
                }).catch(err => done(err))
        })
    })
})
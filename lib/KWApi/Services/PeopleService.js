'use strict';
const AbstractService = require('./AbstractService')

class PeopleService extends AbstractService {
    /**
     * lookup information about specific person by email
     *
     * @param string $email  email address of person
     *
     * @return \KWApi\Models\Response Return response object
     */
    lookupEmail(email) {
        const emails = { email }
        return this.get('people/social/lookupEmail', emails)
    }

    /**
    * lookup information about specific person by phone
    *
    * @param string $phone  phone number of person
    * @param string $countryCode  country code number
    *
    * @return \KWApi\Models\Response Return response object
    */
    lookupPhone(phone, countryCode) {
        countryCode = !!countryCode ? countryCode : ''
        const phones = { phone, countryCode }
        return this.get('people/social/lookupPhone', phones)
    }
}

module.exports = PeopleService

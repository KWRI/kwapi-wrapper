'use strict'

const AbstractService = require('./AbstractService')

class ApiUserService extends AbstractService {
    /**
    * Show list of ApiUsers on system. Using pagination with size of 10 items every page.
    *
    * @return \KWApi\Models\Response Return response object
    */
    browse(page) {
        const query = {}

        if (page != null) {
            query.page = page
        }

        return this.get('api_users', query)
    }
    /**
    * For creating new ApiUser,
    * every new created ApiUser has isActive value 1 by default. ApiKey inputed must be unique.
    *
    * @param string $apiKey
    * @param string $email
    * @param string $company
    * @param string $application
    *
    * @return \KWApi\Models\Response Return response object
    */
    create(apiKey, email, company, application) {
        return this.post('api_users', { apiKey, company, application, email })
    }

    /**
    * Show detail of ApiUser data
    *
    * @param int $id
    *
    * @return \KWApi\Models\Response Return response object
    */
    read(id) {
        return this.get(`api_users/${id}`)
    }

    /**
    * Updating ApiUser data
    *
    * @param int $id
    * @param string $apiKey
    * @param string $company
    * @param string $application
    *
    * @return \KWApi\Models\Response Return response object
    */
    update(id, apiKey, email, company, application) {
        return this.put(`api_users/${id}`, { apiKey, email, company, application })
    }

    /**
     * Set active status of ApiUser inverse from it current value.
     * If isActive 0 then it will be set to 1, vice versa.
     *
     * @param int $id
     *
     * @return \KWApi\Models\Response  Return response object
     */
    toggle(id) {
        return this.get(`api_users/${id}/toogle`)
    }
    /**
    * Deleting ApiUser from database.
    *
    * @param int $id
    *
    * @return \KWApi\Models\Response Return response object
    */
    delete(id) {
        return this.send('DELETE', `api_users/${id}`)
    }
}

module.exports = ApiUserService

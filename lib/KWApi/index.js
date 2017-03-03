const _ = require('lodash')

// Register all services files in the folder Services
const registeredServices = [
    'Abstract',
    'ApiUser',
    'Communication',
    'Demographic',
    'LeadRouting',
    'People',
]

class KWApi {
    constructor(credential) {
        this.credential = credential

        this.endPoint = ''
        if (this.credential.getEndPoint()) {
            this.endPoint = this.credential.getEndPoint()
        }

        this.initiatedServices = {}

        /**
         * construct Services object as singleton object
         */
        _.map(registeredServices, (className) => {
            this[className] = () => {
                if (!_.has(this.initiatedServices, className)) {
                    /* eslint-disable */
                    const Service = require(`./Services/${className}Service`)
                    this.initiatedServices[className] =
                        new Service(this.httpClient, this.credential)
                }
                return this.initiatedServices[className]
            }
        })
    }

    getEndPoint() {
        return this.endPoint
    }
}

module.exports = KWApi

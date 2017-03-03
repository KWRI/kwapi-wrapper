const AbstractService = require('./AbstractService')

class CommunicationService extends AbstractService {
    /**
    * Send Text Message
    *
    * @param string phoneNumber   Valid phone number with country code. eg: +6285778275565
    * @param message message      Message
    *
    * @return \KWApi\Models\Response Return response object
    */
    sendText(phoneNumber, message) {
        const phones = { phoneNumber, message }
        return this.post('communication/send_text', phones)
    }
}

module.exports = CommunicationService

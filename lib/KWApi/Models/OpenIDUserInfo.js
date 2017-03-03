class OpenIDUserInfo {
    constructor(kwUid, email, company, appName) {
        this.kwUid = kwUid
        this.email = email
        this.company = company
        this.appName = appName
    }

    setKWUID(kwUid) {
        this.kwUid = kwUid
    }

    getKWUID() {
        return this.kwUid
    }

    setEmail(email) {
        this.email = email
    }

    getEmail() {
        return this.email
    }

    setCompany(company) {
        this.company = company
    }

    getCompany() {
        return this.company
    }

    setAppName(appName) {
        this.appName = appName
    }

    getAppName() {
        return this.appName
    }

}

module.exports = OpenIDUserInfo

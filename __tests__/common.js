'use strict';
const BasePath = '../lib/'
/* eslint-disable */
const OpenIDToken = require(BasePath + 'KWApi/Models/OpenIDToken')

const OpenIDUserInfo = require(BasePath + 'KWApi/Models/OpenIDUserInfo')

const OpenIDCredential = require(BasePath + 'KWApi/Models/OpenIDCredential')
/* eslint-enable */
const config = require('./src/KWApi/Services/Config.json')

global.apiKey = config.apiKey
global.endPoint = config.endPoint

const chai = require('chai')

chai.should()
chai.use(require('chai-as-promised'))
chai.use(require('chai-shallow-deep-equal'))

global.Axios = require('axios')
global.Moxios = require('moxios')

global.expect = chai.expect

// User info  data
global.kwUid = '999'
global.email = 'pholenkadi17@gmail.com'
global.company = 'Refactory'
global.appName = 'KW-CRM'

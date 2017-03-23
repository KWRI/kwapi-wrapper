# KWApi Client Library
This repository contains PHP and JS Library that allows you to access the KW-API Platform from your PHP app.

## PHP Library

### Installation

This library can be installed with Composer. Run this command:
```
composer require kwri/kwapi-wrapper
```

### Usage

```php
// Use old method (apiKey header)
$credential = new KWApi\Models\Credential("yourApiKey");
$credential->setEndPoint("http://kw-api.dev/v1/");
$service = new KWApi\KWApi($credential);

// Use new method (OpenID connect)

// Token data
$tokenType = 'bearer';
$accessToken = md5(time());
$refreshToken = md5(time()+1);
$expiresIn = 24*3600;

// User info  data
$kwUid = '999';
$email = 'pholenkadi17@gmail.com';
$company = 'Refactory';
$appName = 'KW-CRM';

$token = new KWAPI\Models\OpenIDToken($tokenType, $accessToken, $refreshToken, $expiresIn);
$userInfo = new KWAPI\Models\OpenIDUserInfo($kwUid, $email, $company, $appName);
$credential = new KWAPI\Models\OpenIDCredential($clientId, $token, $userInfo);
$credential->setEndPoint("http://kw-api.dev/v1/");
$service = new KWApi\KWApi($credential);

$response = $service->event()->browse();
```

### Test
1. Start KW-Api Service on local development
2. Copy ```tests/config.php.dist``` to ```tests/config.php``` and set your credential value
3. The test can be executed by running
```
./vendor/bin/phpunit --coverage-text
```

## JS LIbrary

### Installation
To use the library, clone this repository to your local machine.

### Usage
```js
// Use old method (apiKey header)
const BasePath = 'Your/Path/lib/'

const Credential = require(BasePath + 'KWApi/Models/Credential')
const KWAPI = require(BasePath + 'KWApi/')

const credential = new Credential(apiKey)

// There are several services that can be used, please refer at Services dir
const ApiUser = new KWAPI(credential)

// Use new method (OPENID Connect)

// Token data
const tokenType = 'Bearer'
const accessToken = md5(new Date())
const refreshToken = md5(Math.floor(Date.now() / 1000) + 1)
const expiresIn = 24 * 3600

// setUpOpenID
const OpenIDToken = require(BasePath + 'KWApi/Models/OpenIDToken')
const OpenIDUserInfo = require(BasePath + 'KWApi/Models/OpenIDUserInfo')
const OpenIDCredential = require(BasePath + 'KWApi/Models/OpenIDCredential')
//  You can set the clientId as you type
const clientId = "98jjhury866"

const KWAPI = require(BasePath + 'KWApi/')

const token = new OpenIDToken(tokenType, accessToken, refreshToken, expiresIn)
const userInfo = new OpenIDUserInfo(kwUid, email, company, appName)
const credential = new OpenIDCredential(clientId, token, userInfo)

credential.setEndPoint(endPoint)

const KwApi = new KWAPI(credential)
```
### Test
1. Start KW-API Server on local development
2. The test can be executed by running ```npm test``` on your terminal

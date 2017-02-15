# KWApi Client Library
This repository contains PHP Library that allows you to access the KW-API Platform from your PHP app.

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

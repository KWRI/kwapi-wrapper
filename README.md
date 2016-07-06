# KWApi Client Library
This repository contains PHP Library that allows you to access the KW-API Platform from your PHP app.

### Installation

This library can be installed with Composer. Run this command:
```
composer require kwri/kwapi-wrapper
```

### Usage

```php
$credential = new KWApi\Models\Credential("yourApiKey");
$credential->setEndPoint("http://localhost:8001/v1/");
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
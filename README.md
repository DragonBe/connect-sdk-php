# 1Password Connect PHP SDK

The 1Password Connect PHP SDK provides your PHP applications access to the 1Password Connect API hosted on your
infrastructure and leverage the power of [1Password Secrets Automation](https://1password.com/secrets)

The library can be used by PHP applications, tools, and other automations to access and manage items in 1Password
Vaults.

## Installation

You can install the SDK using [composer](https://getcomposer.org/download/)

```shell
composer require dragonbe/connect-sdk-php
```

## Usage

To use the 1Password Connect SDK for PHP, there are two components necessary:

1. The 1Password Connect SDK for PHP (this library)
2. The 1Password Connect Server

Besides these components, you need to configure 1Password (admin level) to allow "Secrets Automation". This process is
fully documented by 1Password, so please
visit [1Password Secrets Automation Workflow](https://developer.1password.com/docs/connect) documentation first. Without
the 1Password Connect Server, this library will not work.

The rest of this documentation makes the assumption you have the 1Password Connect Server already configured and is
listening to port 8080 on localhost. With cURL it is possible to verify this.

```shell
curl \                   
  -H "Accept: application/json" \
  -H "Authorization: Bearer $OP_API_TOKEN" \
  http://127.0.0.1:8080/v1/vaults
```

If you receive a successful response with data from your vaults, you have successfully set up your 1Password Connect
Server. If not, review the documentation to find out if you skipped a step.

```json
[
  {
    "id": "xxxxxxxxxxxxxxxxxxxxxxxxxx",
    "name": "Shared Secrets",
    "content_version": 3,
    "description": "Shared secrets for APIs, online services, and more",
    "attribute_version": 1,
    "items": 2,
    "type": "USER_CREATED",
    "created_at": "2021-05-01T15:20:46Z",
    "updated_at": "2022-06-22T14:33:39Z"
  }
]
```

The rest of this documentation will focus on the usage of the 1Password Connect SDK for PHP. 

## 1Password Connect SDK for PHP

### Environment Variables

In this current version I'm not using environment variables.

### Configuration Settings

For the configuration of the 1Password Connect SDK for PHP I use a PHP config file `local.php` in the directory `/config`. This file is ignored by source control, so it does not accidentally make it into the repository exposing the secret access token.

```php
<?php
declare(strict_types=1);

return [
    '1password' => [
        'access_token' => '*******', // The access token you received from 1Password configuration
    ],
];
```

**PROTIP:** Make sure that this file is read-only, and only accessible for the user account that will run this SDK.

### Creating an API client

For the API client (this library) we need to use this configuration file. The bare minimum you should code is the following:

```php
<?php
declare(strict_types=1);

use OnePassword\Connect\OnePasswordConnectFactory;

require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/config/local.php';

$opc = OnePasswordConnectFactory::create($config['1password']['access_token']);
```

### Retrieving Vaults

Retrieving a list of vaults who have been assigned to this access token, requires a few more lines.

```php
// List a list of vaults
$vaults = $opc->listVaults();
foreach ($vaults as $vault) {
    echo 'Vault: ' . $vault->getName() . ' (' . $vault->getId() . ')' .PHP_EOL;
}
```

This will return something like the following output:

```text
Vault: Shared Secrets (xxxxxxxxxxxxxxxxxxxxxxxxxx)
Shared Secrets contains 2 item(s)
```

To retrieve items in those vaults, a few more lines are needed:

```php
$items = $opc->listItems('xxxxxxxxxxxxxxxxxxxxxxxxxx');
foreach ($items as $item) {
    echo 'Item title: ' . $item->getTitle() . PHP_EOL;
}
```

This will return you the following output:

```text
Item title: Azure Test Access Token: PHP SDK Example v1.0.0
Item title: Azure API Manager
```
### Interacting with Items

### Custom HTTPClient

### Logging with psr/log

The 1Password Connect PHP client uses the [psr/log](https://packagist.org/packages/psr/log) library to log runtime
information.

## Development

This project is a work in progress and has been put a side for a while because of other priorities in life. Updates will appear if you watch this repository for updates.

### Running Tests

To execute the unit tests, you can use `composer test` and it will fire up all PHPUnit tests.

---

# About 1Password

**[1Password](https://1password.com/)** is the world’s most-loved password manager. By combining industry-leading
security and award-winning design, the company provides private, secure, and user-friendly password management to
businesses and consumers globally. More than 60,000 business customers trust 1Password as their enterprise password
manager.

# Security

1Password requests you practice responsible disclosure if you discover a vulnerability. Please submit discoveries
via [BugCrowd](https://bugcrowd.com/agilebits).

For information about security practices, please visit our [Security homepage](https://1password.com/security/).
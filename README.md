# vmware-php

A PHP wrapper for the VMWare API.
This is a pre-alpha release, so stuf isn't working correctly atm.

## Installation
```
composer require enguerr/vmware-api
```

## Guide
Our VMWare API implementation contains the following features:
- Simple login using application passwords.
- Automatic retry functionionality that retries requests when connection errors or status codes >= 500 occur.
- Direct function calls for much used api endpoints.
- Easy syntax for all other endpoints using `$api->request($method, $uri, $json = [], $query = [])`.

```php
// Create a new API instance, endpoint should end on "/rest/".
$api = new \enguerr\VMWare\[Vcenter|Appliance|Inventory]IApi('https://vcenter.local/api/');
```

```php
// LEGACY LOGIN WITH TOKEN
$api->login('yourusername', 'yourpassword');
```

Now your API should be ready to use:
```php
$vms = $api->getListOfVms();

foreach($vms as $vm) {
    var_dump($vm);
}
```

## Documentation
- http://vmware.github.io/vsphere-automation-sdk-rest/7.0/

# mail
Mail package for Bone Mvc Framework
## installation
Use Composer
```
composer require delboy1978uk/bone-mail
```
## usage
Simply add to the `config/packages.php`
```php
<?php

// use statements here
use BoneMvc\Mail\MailPackage;

return [
    'packages' => [
        // packages here...,
        MailPackage::class,
    ],
    // ...
];
```
Add a `config/mail.php` in the config folder. 
```php
<?php

// the docker dev box uses these Mailhog settings
return [
    'mail' => [
        'name' => 'mail', // or 127.0.0.1 etc
        'host' => 'mail', // or localhost etc
        'port' => 1025, // or 25
    ],
];
```
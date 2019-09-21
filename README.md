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
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
### sending email
Any classes that need set up with the `BoneMvc\Mail\Service\MailService` can have it injected via your package class
(remember and add a use statement with the full class) :
```php
$mailService = $c->get(MailService::class);
```
With regards to the `setTemplate()` method, refer to the `league/plates` docs, and `delboy1978uk/bone-user` for an 
example. Variables set in `setViewData()` go to your view template.
```php
$mail = new EmailMessage();
$mail->setTo($email);
$mail->setSubject($subject);
$mail->setTemplate('email.user::user_registration/change_email');
$mail->setViewData([
    'siteUrl' => $env->getSiteURL(),
    'logo' => $this->getSiteConfig()->getEmailLogo(),
    'resetLink' => '/user/reset-email/' . $email . '/' . $newEmail . '/' . $token,
]);
$this->mailService->sendEmail($mail);
```
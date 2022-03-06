[![Latest Stable Version](https://poser.pugx.org/delboy1978uk/bone-mail/v/stable)](https://packagist.org/packages/delboy1978uk/bone-mail) [![Total Downloads](https://poser.pugx.org/delboy1978uk/bone/downloads)](https://packagist.org/packages/delboy1978uk/bone) [![Latest Unstable Version](https://poser.pugx.org/delboy1978uk/bone-mail/v/unstable)](https://packagist.org/packages/delboy1978uk/bone-mail) [![License](https://poser.pugx.org/delboy1978uk/bone-mail/license)](https://packagist.org/packages/delboy1978uk/bone-mail)<br />
![build status](https://github.com/delboy1978uk/bone-mail/actions/workflows/master.yml/badge.svg) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/bone-mail/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bone-mail/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/bone-mail/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bone-mail/?branch=master)<br />

# mail
Mail package for Bone Framework
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
use Bone\Mail\MailPackage;

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
Any classes that need set up with the `Bone\Mail\Service\MailService` can have it injected via your package class
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

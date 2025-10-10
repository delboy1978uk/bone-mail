<?php

declare(strict_types=1);

namespace Bone\Mail;

use Barnacle\Container;
use Barnacle\RegistrationInterface;
use Bone\View\ViewEngine;
use Bone\Server\Environment;
use Bone\Server\SiteConfig;
use Bone\Mail\Service\MailService;
use Laminas\Mail\Transport\Sendmail;
use Laminas\Mail\Transport\Smtp;
use Laminas\Mail\Transport\SmtpOptions;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

class MailPackage implements RegistrationInterface
{
    public function addToContainer(Container $c)
    {
        $c[MailService::class] = $c->factory(function (Container $c) {
            $view = $c->get(ViewEngine::class);
            $siteConfig = $c->get(SiteConfig::class);
            $dsn = \getenv('MAILER_DSN');
            $mailService = new MailService();
            $transport = Transport::fromDsn($dsn);
            $mailer = new Mailer($transport);
            $mailService->setView($view);
            $mailService->setSiteConfig($siteConfig);
            $mailer  = new Mailer($transport);
            $mailService->setMailer($mailer);

            return $mailService;
        });
    }
}

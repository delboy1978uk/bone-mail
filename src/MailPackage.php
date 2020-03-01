<?php

declare(strict_types=1);

namespace BoneMvc\Mail;

use Barnacle\Container;
use Barnacle\RegistrationInterface;
use Bone\View\PlatesEngine;
use Bone\Server\Environment;
use Bone\Server\SiteConfig;
use BoneMvc\Mail\Service\MailService;
use Laminas\Mail\Transport\Sendmail;
use Laminas\Mail\Transport\Smtp;
use Laminas\Mail\Transport\SmtpOptions;

class MailPackage implements RegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $c[MailService::class] = $c->factory(function (Container $c) {
            $view = $c->get(PlatesEngine::class);
            $siteConfig = $c->get(SiteConfig::class);
            $mailService = new MailService();
            $transport = new Sendmail();
            
            if ($c->has('mail')) {
                $settings = $c->get('mail');
                
                if (isset($settings['name'], $settings['host'], $settings['port'])) {
                    $options = new SmtpOptions($settings);
                    $transport = new Smtp($options);
                }
            }
            
            $mailService->setView($view);
            $mailService->setSiteConfig($siteConfig);
            $mailService->setTransport($transport);

            return $mailService;
        });
    }

    /**
     * @return string
     */
    public function getEntityPath(): string
    {
        return '';
    }

    /**
     * @return bool
     */
    public function hasEntityPath(): bool
    {
        return false;
    }
}

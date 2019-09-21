<?php

declare(strict_types=1);

namespace BoneMvc\Mail;

use Barnacle\Container;
use Barnacle\RegistrationInterface;
use Bone\Mvc\View\PlatesEngine;
use BoneMvc\Mail\Service\MailService;
use Zend\Mail\Transport\Sendmail;
use Zend\Mail\Transport\TransportInterface;

class MailPackage implements RegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $c[MailService::class] = $c->factory(function (Container $c) {
            $view = $c->get(PlatesEngine::class);
            $mailService = new MailService($view);
            if ($c->has('mail')) {
                $settings = $c->get('mail');
                $transport = $settings['transport'] ?? new Sendmail();
                $mailService->setTransport($transport);

                return $mailService;
            }
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

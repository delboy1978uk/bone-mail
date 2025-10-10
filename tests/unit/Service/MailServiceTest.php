<?php

namespace Bone\Test\Mail;

use Bone\Mail\EmailMessage;
use Bone\Mail\Service\MailService;
use Bone\Server\SiteConfig;
use Bone\View\ViewEngine;
use Codeception\Test\Unit;
use Symfony\Component\Mailer\Mailer;

class MailServiceTest extends Unit
{
    public function testMailService()
    {
        $mailer = $this->makeEmpty(Mailer::class);
        $message = $this->makeEmpty(EmailMessage::class, [
            'getTemplate' => 'some::template',
            'getViewData' => [],
        ]);
        $view = $this->makeEmpty(ViewEngine::class, [
            'render' => '<html>An email!</html>',
        ]);
        $config = $this->makeEmpty(SiteConfig::class);
        $transport->expects(self::once())->method('send');
        $mail = new MailService();
        $mail->setSiteConfig($config);
        $mail->setView($view);
        $mail->setMailer($mailer);
        $mail->sendEmail($message);
    }
}

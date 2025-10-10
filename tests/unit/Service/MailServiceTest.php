<?php

namespace Bone\Test\Mail;

use Bone\Mail\EmailMessage;
use Bone\Mail\Service\MailService;
use Bone\Server\SiteConfig;
use Bone\View\ViewEngine;
use Codeception\Test\Unit;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

class MailServiceTest extends Unit
{
    public function testMailService()
    {
        $transport = Transport::fromDsn('netive://default');
        $mailer = new Mailer($transport);
        $message = $this->makeEmpty(EmailMessage::class, [
            'getTemplate' => 'some::template',
            'getViewData' => [],
        ]);
        $view = $this->makeEmpty(ViewEngine::class, [
            'render' => '<html>An email!</html>',
        ]);
        $config = $this->makeEmpty(SiteConfig::class);
        $mail = new MailService();
        $mail->setSiteConfig($config);
        $mail->setView($view);
        $mail->setMailer($mailer);
        $mail->sendEmail($message);
    }
}

<?php

namespace Bone\Test\Mail;

use Bone\Mail\EmailMessage;
use Bone\Mail\Service\MailService;
use Bone\Server\SiteConfig;
use Bone\View\ViewEngine;
use Codeception\Test\Unit;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

class MailServiceTest extends Unit
{
    public function testMailService()
    {
        $transport = Transport::fromDsn('sendmail://default');
        $mailer = new Mailer($transport);
        $message = new EmailMessage();
        $message->setTemplate('some::template');
        $message->setViewData([]);
        $message->to('man@work.com');
        $view = $this->makeEmpty(ViewEngine::class, [
            'render' => '<html>An email!</html>',
        ]);
        $config = $this->makeEmpty(SiteConfig::class, [
            'getServerEmail' => 'noreply@site.com',
            'getCompany' => 'Sender McSendface',
        ]);
        $mail = new MailService();
        $mail->setSiteConfig($config);
        $mail->setView($view);
        $mail->setMailer($mailer);
        $this->expectException(TransportException::class); // on Github Actions, no sendmail
        $mail->sendEmail($message);
    }
}

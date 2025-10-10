<?php declare(strict_types=1);

namespace Bone\Mail\Service;

use Bone\View\ViewEngine;
use Bone\Server\SiteConfig;
use Bone\Server\SiteConfigAwareInterface;
use Bone\Server\Traits\HasSiteConfigTrait;
use Bone\View\Traits\HasViewTrait;
use Bone\View\ViewAwareInterface;
use Bone\Mail\EmailMessage;

use Laminas\Mime\Message;
use Laminas\Mime\Part;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\TransportInterface;

class MailService implements SiteConfigAwareInterface, ViewAwareInterface
{

    use HasSiteConfigTrait;
    use HasViewTrait;

    private Mailer $mailer;

    public function setMailer(Mailer $mailer): void
    {
        $this->mailer = $mailer;
    }

    private function renderEmail(string $template, array $data): string
    {
        return $this->view->render($template, $data);
    }

    public function sendEmail(EmailMessage $message): bool
    {
        $config = $this->getSiteConfig();
        $message->setFrom($config->getServerEmail(), $config->getCompany());
        $body = $this->renderEmail($message->getTemplate(), $message->getViewData());
        $message->html($body);
        $mailer = new Mailer($this->transport);
        $mailer->send($message);

        return true;
    }
}

<?php declare(strict_types=1);

namespace BoneMvc\Mail\Service;

use Bone\Mvc\View\PlatesEngine;
use Bone\Server\SiteConfig;
use Bone\Server\SiteConfigAwareInterface;
use Bone\Traits\HasSiteConfigTrait;
use Bone\Traits\HasViewTrait;
use Bone\View\ViewAwareInterface;
use BoneMvc\Mail\EmailMessage;
use Laminas\Mail\Transport\TransportInterface;
use Laminas\Mime\Message;
use Laminas\Mime\Part;

class MailService implements SiteConfigAwareInterface, ViewAwareInterface
{

    use HasSiteConfigTrait;
    use HasViewTrait;

    /** @var TransportInterface $transport */
    private $transport;

    /**
     * @param TransportInterface $transport
     */
    public function setTransport(TransportInterface $transport): void
    {
        $this->transport = $transport;
    }

    /**
     * @param string $template
     * @param array $data
     * @return string
     */
    private function renderEmail(string $template, array $data): string
    {
        return $this->view->render($template, $data);
    }

    /**
     * @param EmailMessage $message
     * @return bool
     */
    public function sendEmail(EmailMessage $message): bool
    {
        $message->setFrom($this->siteConfig->getServerEmail());
        $body = $this->renderEmail($message->getTemplate(), $message->getViewData());
        $msg = new Part($body);
        $msg->type = 'text/html';
        $mime = new Message();
        $mime->setParts([$msg]);
        $message->setBody($mime);
        $this->transport->send($message);

        return true;
    }
}

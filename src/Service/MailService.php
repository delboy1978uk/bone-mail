<?php declare(strict_types=1);

namespace BoneMvc\Mail\Service;

use Bone\Mvc\View\PlatesEngine;
use BoneMvc\Mail\EmailMessage;
use Zend\Mail\Transport\TransportInterface;
use Zend\Mime\Message;
use Zend\Mime\Part;

class MailService
{
    /** @var PlatesEngine $view */
    private $view;

    /** @var TransportInterface $transport */
    private $transport;

    /**
     * MailService constructor.
     * @param PlatesEngine $view
     */
    public function __construct(PlatesEngine $view)
    {
        $this->view = $view;
    }

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

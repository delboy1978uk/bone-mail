<?php

namespace Bone\Mail;

use Symfony\Component\Mime\Email;

class EmailMessage extends Email
{
    private array $viewData= [];
    private string $template = '';

    public function getViewData(): array
    {
        return $this->viewData;
    }

    public function setViewData(array $viewData): void
    {
        $this->viewData = $viewData;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }

    public function setFrom(string $email, ?string $name = null): void
    {
        $from = $name ? [$email => $name] : $email;
        $this->from($from);
    }

    public function setTo(string $email, ?string $name = null): void
    {
        $to = $name ? [$email => $name] : $email;
        $this->to($to);
    }

    public function setSubject(string $subject): void
    {
        $this->subject($subject);
    }
}

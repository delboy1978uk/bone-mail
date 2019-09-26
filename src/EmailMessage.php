<?php

namespace BoneMvc\Mail;

use Zend\Mail\Message;

class EmailMessage extends Message
{
    /** @var array $viewData */
    private $viewData= [];

    /** @var string $template */
    private $template = '';

    /**
     * @return array
     */
    public function getViewData()
    {
        return $this->viewData;
    }

    /**
     * @param array $viewData
     */
    public function setViewData(array $viewData): void
    {
        $this->viewData = $viewData;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }
}
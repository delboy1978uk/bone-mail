<?php

namespace Bone\Test\Mail;

use Bone\Mail\EmailMessage;
use Codeception\Test\Unit;

class EmailMessageTest extends Unit
{
    public function testEmailMessage()
    {
        $mail = new EmailMessage();
        $mail->setTemplate('some::template');
        $mail->setViewData([
            'some' => 'data'
        ]);
        $this->assertEquals('some::template', $mail->getTemplate());
        $this->assertIsArray($mail->getViewData());
        $this->assertCount(1, $mail->getViewData());
        $this->assertArrayHasKey('some', $mail->getViewData());
        $this->assertEquals('data', $mail->getViewData()['some']);
    }
}

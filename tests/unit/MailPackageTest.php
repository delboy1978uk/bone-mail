<?php

namespace Bone\Test\Mail;

use Barnacle\Container;
use Bone\Mail\MailPackage;
use Bone\Mail\Service\MailService;
use Bone\Server\SiteConfig;
use Bone\View\ViewEngine;
use Bone\View\ViewEngineInterface;
use Codeception\Test\Unit;

class MailPackageTest extends Unit
{
    public function testMailPackage()
    {
        $c = new Container();
        $c['mail'] = [
            'name' => 'mail',
            'host' => 'mail',
            'port' => 1025,
        ];
        $c[ViewEngine::class] = $this->makeEmpty(ViewEngine::class);
        $c[SiteConfig::class] = $this->makeEmpty(SiteConfig::class);
        $package = new MailPackage();
        $package->addToContainer($c);
        $this->assertTrue($c->has(MailService::class));
        $this->assertInstanceOf(MailService::class, $c->get(MailService::class));
    }
}

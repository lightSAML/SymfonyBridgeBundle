<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Bridge\Container;

use LightSaml\Store\Credential\CredentialStoreInterface;
use LightSaml\SymfonyBridgeBundle\Bridge\Container\CredentialContainer;
use LightSaml\SymfonyBridgeBundle\Tests\TestHelper;
use PHPUnit\Framework\TestCase;

class CredentialContainerTest extends TestCase
{
    public function test_returns_credential_store()
    {
        $container = new CredentialContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.credential.credential_store')
            ->willReturn($expected = $this->getMock(CredentialStoreInterface::class));

        $this->assertSame($expected, $container->getCredentialStore());
    }
}

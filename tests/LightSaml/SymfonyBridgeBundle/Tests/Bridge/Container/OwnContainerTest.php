<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Bridge\Container;

use LightSaml\Credential\CredentialInterface;
use LightSaml\Provider\EntityDescriptor\EntityDescriptorProviderInterface;
use LightSaml\Store\Credential\CredentialStoreInterface;
use LightSaml\SymfonyBridgeBundle\Bridge\Container\OwnContainer;
use LightSaml\SymfonyBridgeBundle\Tests\TestHelper;
use PHPUnit\Framework\TestCase;

class OwnContainerTest extends TestCase
{
    public function test_returns_own_entity_provider()
    {
        $container = new OwnContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.own.entity_descriptor_provider')
            ->willReturn($expected = $this->getMockBuilder(EntityDescriptorProviderInterface::class)->getMock());

        $this->assertSame($expected, $container->getOwnEntityDescriptorProvider());
    }

    public function test_returns_own_credentials()
    {
        $container = new OwnContainer($containerMock = TestHelper::getContainerMock($this));

        $containerMock->method('get')
            ->with('lightsaml.own.credential_store')
            ->willReturn($credentialStoreMock = $this->getMockBuilder(CredentialStoreInterface::class)->getMock());
        $containerMock->method('getParameter')
            ->with('lightsaml.own.entity_id')
            ->willReturn('foo');

        $credentialStoreMock->method('getByEntityId')
            ->willReturn([$expected = $this->getMockBuilder(CredentialInterface::class)->getMock()]);

        $result = $container->getOwnCredentials();
        $this->assertTrue(is_array($result));
        $this->assertSame($expected, $result[0]);
    }
}

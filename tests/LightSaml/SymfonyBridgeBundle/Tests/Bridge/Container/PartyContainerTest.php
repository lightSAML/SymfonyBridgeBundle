<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Bridge\Container;

use LightSaml\Store\EntityDescriptor\EntityDescriptorStoreInterface;
use LightSaml\Store\TrustOptions\TrustOptionsStoreInterface;
use LightSaml\SymfonyBridgeBundle\Bridge\Container\PartyContainer;
use LightSaml\SymfonyBridgeBundle\Tests\TestHelper;
use PHPUnit\Framework\TestCase;

class PartyContainerTest extends TestCase
{
    public function test_returns_idp_entity_descriptor_store()
    {
        $container = new PartyContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.party.idp_entity_descriptor_store')
            ->willReturn($expected = $this->getMockBuilder(EntityDescriptorStoreInterface::class)->getMock());

        $this->assertSame($expected, $container->getIdpEntityDescriptorStore());
    }

    public function test_returns_sp_entity_descriptor_store()
    {
        $container = new PartyContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.party.sp_entity_descriptor_store')
            ->willReturn($expected = $this->getMockBuilder(EntityDescriptorStoreInterface::class)->getMock());

        $this->assertSame($expected, $container->getSpEntityDescriptorStore());
    }

    public function test_returns_trust_options_store()
    {
        $container = new PartyContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.party.trust_options_store')
            ->willReturn($expected = $this->getMockBuilder(TrustOptionsStoreInterface::class)->getMock());

        $this->assertSame($expected, $container->getTrustOptionsStore());
    }
}

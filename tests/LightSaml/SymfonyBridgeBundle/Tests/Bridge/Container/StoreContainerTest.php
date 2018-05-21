<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Bridge\Container;

use LightSaml\Store\Id\IdStoreInterface;
use LightSaml\Store\Request\RequestStateStoreInterface;
use LightSaml\Store\Sso\SsoStateStoreInterface;
use LightSaml\SymfonyBridgeBundle\Bridge\Container\StoreContainer;
use LightSaml\SymfonyBridgeBundle\Tests\TestHelper;
use PHPUnit\Framework\TestCase;

class StoreContainerTest extends TestCase
{
    public function test_returns_request_state_store()
    {
        $container = new StoreContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.store.request')
            ->willReturn($expected = $this->getMockBuilder(RequestStateStoreInterface::class)->getMock());

        $this->assertSame($expected, $container->getRequestStateStore());
    }

    public function test_returns_id_state_store()
    {
        $container = new StoreContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.store.id_state')
            ->willReturn($expected = $this->getMockBuilder(IdStoreInterface::class)->getMock());

        $this->assertSame($expected, $container->getIdStateStore());
    }

    public function test_returns_sso_state_store()
    {
        $container = new StoreContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.store.sso_state')
            ->willReturn($expected = $this->getMockBuilder(SsoStateStoreInterface::class)->getMock());

        $this->assertSame($expected, $container->getSsoStateStore());
    }
}

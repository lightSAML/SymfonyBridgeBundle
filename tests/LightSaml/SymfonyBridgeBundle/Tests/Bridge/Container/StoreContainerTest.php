<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Bridge\Container;

use LightSaml\Store\Id\IdStoreInterface;
use LightSaml\Store\Request\RequestStateStoreInterface;
use LightSaml\Store\Sso\SsoStateStoreInterface;
use LightSaml\SymfonyBridgeBundle\Bridge\Container\StoreContainer;
use PHPUnit\Framework\TestCase;

class StoreContainerTest extends TestCase
{
    public function test_constructs_with_all_arguments()
    {
        new StoreContainer(
            $this->prophesize(RequestStateStoreInterface::class)->reveal(),
            $this->prophesize(IdStoreInterface::class)->reveal(),
            $this->prophesize(SsoStateStoreInterface::class)->reveal()
        );
    }
}

<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Bridge\Container;

use LightSaml\Build\Container\CredentialContainerInterface;
use LightSaml\Build\Container\OwnContainerInterface;
use LightSaml\Build\Container\PartyContainerInterface;
use LightSaml\Build\Container\ProviderContainerInterface;
use LightSaml\Build\Container\ServiceContainerInterface;
use LightSaml\Build\Container\StoreContainerInterface;
use LightSaml\Build\Container\SystemContainerInterface;
use LightSaml\SymfonyBridgeBundle\Bridge\Container\BuildContainer;
use PHPUnit\Framework\TestCase;

class BuildContainerTest extends TestCase
{
    public function test_constructs_with_all_containers()
    {
        new BuildContainer(
            $this->prophesize(SystemContainerInterface::class)->reveal(),
            $this->prophesize(PartyContainerInterface::class)->reveal(),
            $this->prophesize(StoreContainerInterface::class)->reveal(),
            $this->prophesize(ProviderContainerInterface::class)->reveal(),
            $this->prophesize(CredentialContainerInterface::class)->reveal(),
            $this->prophesize(ServiceContainerInterface::class)->reveal(),
            $this->prophesize(OwnContainerInterface::class)->reveal()
        );
    }
}

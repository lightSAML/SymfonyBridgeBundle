<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Bridge\Container;

use LightSaml\Provider\TimeProvider\TimeProviderInterface;
use LightSaml\SymfonyBridgeBundle\Bridge\Container\SystemContainer;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SystemContainerTest extends TestCase
{
    public function test_constructs_with_all_arguments()
    {
        new SystemContainer(
            $this->prophesize(RequestStack::class)->reveal(),
            $this->prophesize(SessionInterface::class)->reveal(),
            $this->prophesize(TimeProviderInterface::class)->reveal(),
            $this->prophesize(EventDispatcherInterface::class)->reveal(),
            $this->prophesize(LoggerInterface::class)->reveal()
        );
    }
}

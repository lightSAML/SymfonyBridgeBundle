<?php

namespace LightSaml\SymfonyBridgeBundle\Tests;

use PHPUnit\Framework\TestCase;

abstract class TestHelper
{
    /**
     * @param TestCase $test
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|\Symfony\Component\DependencyInjection\ContainerInterface
     */
    public static function getContainerMock(TestCase $test)
    {
        return $test->getMockBuilder(\Symfony\Component\DependencyInjection\ContainerInterface::class)
            ->getMock();
    }
}

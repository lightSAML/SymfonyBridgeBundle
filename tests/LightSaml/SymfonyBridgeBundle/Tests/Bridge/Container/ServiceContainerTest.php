<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Bridge\Container;

use LightSaml\Binding\BindingFactoryInterface;
use LightSaml\Resolver\Credential\CredentialResolverInterface;
use LightSaml\Resolver\Endpoint\EndpointResolverInterface;
use LightSaml\Resolver\Session\SessionProcessorInterface;
use LightSaml\Resolver\Signature\SignatureResolverInterface;
use LightSaml\SymfonyBridgeBundle\Bridge\Container\ServiceContainer;
use LightSaml\Validator\Model\Assertion\AssertionTimeValidatorInterface;
use LightSaml\Validator\Model\Assertion\AssertionValidatorInterface;
use LightSaml\Validator\Model\NameId\NameIdValidatorInterface;
use LightSaml\Validator\Model\Signature\SignatureValidatorInterface;
use PHPUnit\Framework\TestCase;

class ServiceContainerTest extends TestCase
{
    public function test_constructs_with_all_arguments()
    {
        new ServiceContainer(
            $this->prophesize(AssertionValidatorInterface::class)->reveal(),
            $this->prophesize(AssertionTimeValidatorInterface::class)->reveal(),
            $this->prophesize(SignatureResolverInterface::class)->reveal(),
            $this->prophesize(EndpointResolverInterface::class)->reveal(),
            $this->prophesize(NameIdValidatorInterface::class)->reveal(),
            $this->prophesize(BindingFactoryInterface::class)->reveal(),
            $this->prophesize(SignatureValidatorInterface::class)->reveal(),
            $this->prophesize(CredentialResolverInterface::class)->reveal(),
            $this->prophesize(SessionProcessorInterface::class)->reveal()
        );
    }
}

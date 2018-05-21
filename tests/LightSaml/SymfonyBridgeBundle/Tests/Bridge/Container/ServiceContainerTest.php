<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Bridge\Container;

use LightSaml\Binding\BindingFactoryInterface;
use LightSaml\Resolver\Credential\CredentialResolverInterface;
use LightSaml\Resolver\Endpoint\EndpointResolverInterface;
use LightSaml\Resolver\Session\SessionProcessorInterface;
use LightSaml\Resolver\Signature\SignatureResolverInterface;
use LightSaml\SymfonyBridgeBundle\Bridge\Container\ServiceContainer;
use LightSaml\SymfonyBridgeBundle\Tests\TestHelper;
use LightSaml\Validator\Model\Assertion\AssertionTimeValidatorInterface;
use LightSaml\Validator\Model\Assertion\AssertionValidatorInterface;
use LightSaml\Validator\Model\NameId\NameIdValidatorInterface;
use LightSaml\Validator\Model\Signature\SignatureValidatorInterface;
use PHPUnit\Framework\TestCase;

class ServiceContainerTest extends TestCase
{
    public function test_returns_assertion_validator()
    {
        $container = new ServiceContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.service.assertion_validator')
            ->willReturn($expected = $this->getMockBuilder(AssertionValidatorInterface::class)->getMock());

        $this->assertSame($expected, $container->getAssertionValidator());
    }

    public function test_returns_assertion_time_validator()
    {
        $container = new ServiceContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.service.assertion_time_validator')
            ->willReturn($expected = $this->getMockBuilder(AssertionTimeValidatorInterface::class)->getMock());

        $this->assertSame($expected, $container->getAssertionTimeValidator());
    }

    public function test_returns_signature_resolver()
    {
        $container = new ServiceContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.service.signature_resolver')
            ->willReturn($expected = $this->getMockBuilder(SignatureResolverInterface::class)->getMock());

        $this->assertSame($expected, $container->getSignatureResolver());
    }

    public function test_returns_endpoint_resolver()
    {
        $container = new ServiceContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.service.endpoint_resolver')
            ->willReturn($expected = $this->getMockBuilder(EndpointResolverInterface::class)->getMock());

        $this->assertSame($expected, $container->getEndpointResolver());
    }

    public function test_returns_name_id_validator()
    {
        $container = new ServiceContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.service.name_id_validator')
            ->willReturn($expected = $this->getMockBuilder(NameIdValidatorInterface::class)->getMock());

        $this->assertSame($expected, $container->getNameIdValidator());
    }

    public function test_returns_binding_factory()
    {
        $container = new ServiceContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.service.binding_factory')
            ->willReturn($expected = $this->getMockBuilder(BindingFactoryInterface::class)->getMock());

        $this->assertSame($expected, $container->getBindingFactory());
    }

    public function test_returns_signature_validator()
    {
        $container = new ServiceContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.service.signature_validator')
            ->willReturn($expected = $this->getMockBuilder(SignatureValidatorInterface::class)->getMock());

        $this->assertSame($expected, $container->getSignatureValidator());
    }

    public function test_returns_credential_resolver()
    {
        $container = new ServiceContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.service.credential_resolver')
            ->willReturn($expected = $this->getMockBuilder(CredentialResolverInterface::class)->getMock());

        $this->assertSame($expected, $container->getCredentialResolver());
    }

    public function test_returns_logout_session_resolver()
    {
        $container = new ServiceContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.service.logout_resolver')
            ->willReturn($expected = new \stdClass());

        $this->assertSame($expected, $container->getLogoutSessionResolver());
    }

    public function test_returns_session_processor()
    {
        $container = new ServiceContainer($containerMock = TestHelper::getContainerMock($this));
        $containerMock->method('get')
            ->with('lightsaml.service.session_processor')
            ->willReturn($expected = $this->getMockBuilder(SessionProcessorInterface::class)->getMock());

        $this->assertSame($expected, $container->getSessionProcessor());
    }
}

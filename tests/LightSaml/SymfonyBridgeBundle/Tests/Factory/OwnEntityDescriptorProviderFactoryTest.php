<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Factory;

use LightSaml\Credential\X509Certificate;
use LightSaml\Credential\X509CredentialInterface;
use LightSaml\Provider\EntityDescriptor\EntityDescriptorProviderInterface;
use LightSaml\Store\Credential\CredentialStoreInterface;
use LightSaml\SymfonyBridgeBundle\Factory\OwnEntityDescriptorProviderFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\Routing\RouterInterface;

class OwnEntityDescriptorProviderFactoryTest extends TestCase
{
    public function test_returns_entity_descriptor_builder()
    {
        $factory = new OwnEntityDescriptorProviderFactory();

        $routerMock = $this->prophesize(RouterInterface::class);
        $routerMock->generate(Argument::type('string'), [], RouterInterface::ABSOLUTE_URL)
            ->shouldBeCalledTimes(2)
            ->willReturn('http://localhost');

        $credentialStoreMock = $this->prophesize(CredentialStoreInterface::class);
        $credentialStoreMock->getByEntityId($ownEntityId = 'own-id')
            ->willReturn([$credentialMock = $this->prophesize(X509CredentialInterface::class)]);

        $credentialMock->getCertificate()
            ->willReturn($this->prophesize(X509Certificate::class));

        $value = $factory->build(
            $ownEntityId,
            $routerMock->reveal(),
            'acs',
            'sso',
            $credentialStoreMock->reveal()
        );

        $this->assertInstanceOf(EntityDescriptorProviderInterface::class, $value);
    }
}

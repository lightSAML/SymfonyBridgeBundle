<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Functional;

use LightSaml\Build\Container\BuildContainerInterface;
use LightSaml\Build\Container\OwnContainerInterface;
use LightSaml\Build\Container\PartyContainerInterface;
use LightSaml\Build\Container\StoreContainerInterface;
use LightSaml\Build\Container\SystemContainerInterface;
use LightSaml\Credential\CredentialInterface;
use LightSaml\Provider\Attribute\AttributeValueProviderInterface;
use LightSaml\Provider\EntityDescriptor\EntityDescriptorProviderInterface;
use LightSaml\Provider\NameID\NameIdProviderInterface;
use LightSaml\Provider\Session\SessionInfoProviderInterface;
use LightSaml\Provider\TimeProvider\TimeProviderInterface;
use LightSaml\Store\EntityDescriptor\EntityDescriptorStoreInterface;
use LightSaml\Store\Id\IdStoreInterface;
use LightSaml\Store\Request\RequestStateStoreInterface;
use LightSaml\Store\Sso\SsoStateStoreInterface;
use LightSaml\Store\TrustOptions\TrustOptionsStoreInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class FunctionalTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $_SERVER['KERNEL_CLASS'] = TestKernel::class;
    }

    public function test_build_container()
    {
        static::bootKernel();
        /** @var BuildContainerInterface $buildContainer */
        $buildContainer = static::$kernel->getContainer()->get('lightsaml.container.build');
        $this->assertInstanceOf(BuildContainerInterface::class, $buildContainer);
        $this->assertInstanceOf(SystemContainerInterface::class, $buildContainer->getSystemContainer());
        $this->assertInstanceOf(OwnContainerInterface::class, $buildContainer->getOwnContainer());
        $this->assertInstanceOf(PartyContainerInterface::class, $buildContainer->getPartyContainer());
        $this->assertInstanceOf(StoreContainerInterface::class, $buildContainer->getStoreContainer());
    }

    public function test_system_container() {
        static::bootKernel();
        /** @var BuildContainerInterface $buildContainer */
        $buildContainer = static::$kernel->getContainer()->get('lightsaml.container.build');
        $systemContainer = $buildContainer->getSystemContainer();
        $this->assertInstanceOf(EventDispatcherInterface::class, $systemContainer->getEventDispatcher());
        $this->assertInstanceOf(LoggerInterface::class, $systemContainer->getLogger());
        $this->assertInstanceOf(TimeProviderInterface::class, $systemContainer->getTimeProvider());
    }

    public function test_party_container()
    {
        static::bootKernel();
        /** @var BuildContainerInterface $buildContainer */
        $buildContainer = static::$kernel->getContainer()->get('lightsaml.container.build');
        $partyContainer = $buildContainer->getPartyContainer();
        $this->assertInstanceOf(EntityDescriptorStoreInterface::class, $partyContainer->getIdpEntityDescriptorStore());
        $this->assertInstanceOf(EntityDescriptorStoreInterface::class, $partyContainer->getSpEntityDescriptorStore());
        $this->assertInstanceOf(TrustOptionsStoreInterface::class, $partyContainer->getTrustOptionsStore());
    }

    public function test_store_container()
    {
        static::bootKernel();
        /** @var BuildContainerInterface $buildContainer */
        $buildContainer = static::$kernel->getContainer()->get('lightsaml.container.build');
        $storeContainer = $buildContainer->getStoreContainer();
        $this->assertInstanceOf(RequestStateStoreInterface::class, $storeContainer->getRequestStateStore());
        $this->assertInstanceOf(IdStoreInterface::class, $storeContainer->getIdStateStore());
        $this->assertInstanceOf(SsoStateStoreInterface::class, $storeContainer->getSsoStateStore());
    }

    public function test_provider_container()
    {
        static::bootKernel();
        /** @var BuildContainerInterface $buildContainer */
        $buildContainer = static::$kernel->getContainer()->get('lightsaml.container.build');
        $providerContainer = $buildContainer->getProviderContainer();
        $this->assertInstanceOf(AttributeValueProviderInterface::class, $providerContainer->getAttributeValueProvider());
        $this->assertInstanceOf(SessionInfoProviderInterface::class, $providerContainer->getSessionInfoProvider());
        $this->assertInstanceOf(NameIdProviderInterface::class, $providerContainer->getNameIdProvider());
    }


    public function test_own_container()
    {
        static::bootKernel();
        /** @var BuildContainerInterface $buildContainer */
        $buildContainer = static::$kernel->getContainer()->get('lightsaml.container.build');
        $ownContainer = $buildContainer->getOwnContainer();
        $this->assertInstanceOf(EntityDescriptorProviderInterface::class, $ownContainer->getOwnEntityDescriptorProvider());
        $this->assertInternalType('array', $ownContainer->getOwnCredentials());
        array_map(function ($credential) {
            $this->assertInstanceOf(CredentialInterface::class, $credential);
        }, $ownContainer->getOwnCredentials());
    }
}
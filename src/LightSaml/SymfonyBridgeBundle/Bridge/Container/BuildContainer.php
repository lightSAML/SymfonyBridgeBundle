<?php

/*
 * This file is part of the LightSAML Symfony Bridge Bundle package.
 *
 * (c) Milos Tomic <tmilos@lightsaml.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace LightSaml\SymfonyBridgeBundle\Bridge\Container;

use LightSaml\Build\Container\BuildContainerInterface;
use LightSaml\Build\Container\CredentialContainerInterface;
use LightSaml\Build\Container\OwnContainerInterface;
use LightSaml\Build\Container\PartyContainerInterface;
use LightSaml\Build\Container\ProviderContainerInterface;
use LightSaml\Build\Container\ServiceContainerInterface;
use LightSaml\Build\Container\StoreContainerInterface;
use LightSaml\Build\Container\SystemContainerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BuildContainer extends AbstractContainer implements BuildContainerInterface
{
    /** @var SystemContainerInterface */
    private $systemsystemContainer;

    /** @var PartyContainerInterface */
    private $partypartyContainer;

    /** @var StoreContainerInterface */
    private $storeContainer;

    /** @var OwnContainerInterface */
    private $ownContainer;

    /** @var AbstractContainer[] */
    private $containers = [];

    /** @var ProviderContainerInterface */
    private $providerContainer;

    /**
     * @param ContainerInterface    $container
     * @param OwnContainerInterface $ownContainer
     */
    public function __construct(ContainerInterface $container,
        SystemContainerInterface $systemContainer,
        PartyContainerInterface $partyContainer,
        StoreContainerInterface $storeContainer,
        ProviderContainerInterface $providerContainer,
        OwnContainerInterface $ownContainer
    ) {
        parent::__construct($container);

        $this->systemsystemContainer = $systemContainer;
        $this->partypartyContainer = $partyContainer;
        $this->storeContainer = $storeContainer;
        $this->providerContainer = $providerContainer;
        $this->ownContainer = $ownContainer;
    }

    /**
     * @return SystemContainerInterface
     */
    public function getSystemContainer()
    {
        return $this->systemsystemContainer;
    }

    /**
     * @return PartyContainerInterface
     */
    public function getPartyContainer()
    {
        return $this->partypartyContainer;
    }

    /**
     * @return StoreContainerInterface
     */
    public function getStoreContainer()
    {
        return $this->storeContainer;
    }

    /**
     * @return ProviderContainerInterface
     */
    public function getProviderContainer()
    {
        return $this->providerContainer;
    }

    /**
     * @return CredentialContainerInterface
     */
    public function getCredentialContainer()
    {
        return $this->getContainer(CredentialContainer::class);
    }

    /**
     * @return ServiceContainerInterface
     */
    public function getServiceContainer()
    {
        return $this->getContainer(ServiceContainer::class);
    }

    /**
     * @return OwnContainerInterface
     */
    public function getOwnContainer()
    {
        return $this->ownContainer;
    }

    /**
     * @param string $class
     *
     * @return AbstractContainer
     */
    private function getContainer($class)
    {
        if (false === isset($this->containers[$class])) {
            $this->containers[$class] = new $class($this->container);
        }

        return $this->containers[$class];
    }
}

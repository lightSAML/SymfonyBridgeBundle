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

class BuildContainer extends AbstractContainer implements BuildContainerInterface
{
    /** @var AbstractContainer[] */
    private $containers = [];

    /**
     * @return SystemContainerInterface
     */
    public function getSystemContainer()
    {
        return $this->getContainer('SystemContainer');
    }

    /**
     * @return PartyContainerInterface
     */
    public function getPartyContainer()
    {
        return $this->getContainer('PartyContainer');
    }

    /**
     * @return StoreContainerInterface
     */
    public function getStoreContainer()
    {
        return $this->getContainer('StoreContainer');
    }

    /**
     * @return ProviderContainerInterface
     */
    public function getProviderContainer()
    {
        return $this->getContainer('ProviderContainer');
    }

    /**
     * @return CredentialContainerInterface
     */
    public function getCredentialContainer()
    {
        return $this->getContainer('CredentialContainer');
    }

    /**
     * @return ServiceContainerInterface
     */
    public function getServiceContainer()
    {
        return $this->getContainer('ServiceContainer');
    }

    /**
     * @return OwnContainerInterface
     */
    public function getOwnContainer()
    {
        return $this->getContainer('OwnContainer');
    }

    /**
     * @param string $class
     *
     * @return AbstractContainer
     */
    private function getContainer($className)
    {
        $fullName = 'LightSaml\SymfonyBridgeBundle\Bridge\Container\\' . $className;

        if (false === isset($this->containers[$className])) {
            $this->containers[$className] = new $fullName($this->container);
        }

        return $this->containers[$className];
    }
}

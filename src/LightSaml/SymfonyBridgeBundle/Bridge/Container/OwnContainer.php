<?php

namespace LightSaml\SymfonyBridgeBundle\Bridge\Container;

use LightSaml\Build\Container\OwnContainerInterface;
use LightSaml\Credential\CredentialInterface;
use LightSaml\Provider\EntityDescriptor\EntityDescriptorProviderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class OwnContainer extends AbstractContainer implements OwnContainerInterface
{
    /**
     * @return EntityDescriptorProviderInterface
     */
    public function getOwnEntityDescriptorProvider()
    {
        return $this->container->get('lightsaml.own.entity_descriptor_provider');
    }

    /**
     * @return CredentialInterface[]
     */
    public function getOwnCredentials()
    {
        return $this->container->get('lightsaml.own.credential_store')->getByEntityId(
            $this->container->getParameter('lightsaml.own.entity_id')
        );
    }
}

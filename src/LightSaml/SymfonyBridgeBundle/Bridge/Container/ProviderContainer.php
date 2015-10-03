<?php

namespace LightSaml\SymfonyBridgeBundle\Bridge\Container;

use LightSaml\Build\Container\ProviderContainerInterface;
use LightSaml\Provider\Attribute\AttributeNameProviderInterface;
use LightSaml\Provider\Attribute\AttributeValueProviderInterface;
use LightSaml\Provider\NameID\NameIdProviderInterface;
use LightSaml\Provider\Session\SessionInfoProviderInterface;

class ProviderContainer extends AbstractContainer implements ProviderContainerInterface
{
    /**
     * @return AttributeValueProviderInterface
     */
    public function getAttributeValueProvider()
    {
        return $this->container->get('lightsaml.provider.attribute_value');
    }

    /**
     * @return AttributeNameProviderInterface
     */
    public function getAttributeNameProvider()
    {
        return $this->container->get('lightsaml.provider.attribute_name');
    }

    /**
     * @return SessionInfoProviderInterface
     */
    public function getSessionInfoProvider()
    {
        return $this->container->get('lightsaml.provider.session_info');
    }

    /**
     * @return NameIdProviderInterface
     */
    public function getNameIdProvider()
    {
        return $this->container->get('lightsaml.provider.name_id');
    }
}

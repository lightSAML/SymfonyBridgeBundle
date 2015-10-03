<?php

namespace LightSaml\SymfonyBridgeBundle\Bridge\Container;

use LightSaml\Build\Container\StoreContainerInterface;
use LightSaml\Store\Id\IdStoreInterface;
use LightSaml\Store\Request\RequestStateStoreInterface;
use LightSaml\Store\Sso\SsoStateStoreInterface;

class StoreContainer extends AbstractContainer implements StoreContainerInterface
{
    /**
     * @return RequestStateStoreInterface
     */
    public function getRequestStateStore()
    {
        return $this->container->get('lightsaml.store.request');
    }

    /**
     * @return IdStoreInterface
     */
    public function getIdStateStore()
    {
        return $this->container->get('lightsaml.store.id_state');
    }

    /**
     * @return SsoStateStoreInterface
     */
    public function getSsoStateStore()
    {
        return $this->container->get('lightsaml.store.sso_state');
    }
}

<?php

namespace LightSaml\SymfonyBridgeBundle\Factory;

use LightSaml\Store\Sso\SsoStateSessionStore;
use Symfony\Component\HttpFoundation\RequestStack;

class SsoStateSessionStoreFactory
{
    public function __construct(
        private RequestStack $requestStack,
        private string       $ssoStateSessionKey,
    ) {
    }

    public function create(): SsoStateSessionStore
    {
        return new SsoStateSessionStore(
            $this->requestStack->getMasterRequest()?->getSession(),
            $this->ssoStateSessionKey
        );
    }
}

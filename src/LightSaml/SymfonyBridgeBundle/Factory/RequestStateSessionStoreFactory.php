<?php

namespace LightSaml\SymfonyBridgeBundle\Factory;

use LightSaml\Store\Request\RequestStateSessionStore;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestStateSessionStoreFactory
{
    public function __construct(
        private RequestStack $requestStack,
        private string $requestSessionPrefix,
        private string $requestSessionSuffix,
    ) {
    }

    public function create(): RequestStateSessionStore
    {
        return new RequestStateSessionStore(
            $this->requestStack->getMasterRequest()?->getSession(),
            $this->requestSessionPrefix,
            $this->requestSessionSuffix
        );
    }
}

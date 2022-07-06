<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\Functional;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel
{

    /**
     * Returns an array of bundles to register.
     *
     * @return iterable|BundleInterface[] An iterable of bundle instances
     */
    public function registerBundles(): iterable
    {
        $bundles = [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \LightSaml\SymfonyBridgeBundle\LightSamlSymfonyBridgeBundle(),
        ];

        return $bundles;
    }

    public function getProjectDir(): string
    {
        return __DIR__;
    }

    /**
     * Loads the container configuration.
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        if (self::MAJOR_VERSION === 5) {
            $loader->load(__DIR__ . '/config_sf5.yml');
        } else {
            $loader->load(__DIR__ . '/config_sf6.yml');
        }
    }
}

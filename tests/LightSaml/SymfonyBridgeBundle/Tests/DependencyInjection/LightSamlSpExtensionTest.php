<?php

namespace LightSaml\SymfonyBridgeBundle\Tests\DependencyInjection;

use LightSaml\SymfonyBridgeBundle\DependencyInjection\LightSamlSymfonyBridgeExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class LightSamlSpExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadsWithConfiguration()
    {
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension = new LightSamlSymfonyBridgeExtension();
        $config = $this->getDefaultConfig();

        $extension->load($config, $containerBuilder);
    }

    public function testLoadsBuildContainer()
    {
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension = new LightSamlSymfonyBridgeExtension();
        $config = $this->getDefaultConfig();
        $extension->load($config, $containerBuilder);

        $this->assertTrue($containerBuilder->hasDefinition('lightsaml.container.build'));
        $this->assertEquals('LightSaml\SymfonyBridgeBundle\Bridge\Container\BuildContainer', $containerBuilder->getDefinition('lightsaml.container.build')->getClass());
    }

    public function testSetEntityIdParameterFromConfiguration()
    {
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension = new LightSamlSymfonyBridgeExtension();
        $config = $this->getDefaultConfig();
        $extension->load($config, $containerBuilder);

        $this->assertEquals($config['lightsaml']['own']['entity_id'], $containerBuilder->getParameter('lightsaml.own.entity_id'));
    }

    public function testSetsOwnEntityDescriptorProviderFactoryFromEntityDescriptorFile()
    {
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension = new LightSamlSymfonyBridgeExtension();
        $config = $this->getDefaultConfig();
        $config['lightsaml']['own']['entity_descriptor_provider']['filename'] = 'file.xml';
        $extension->load($config, $containerBuilder);

        $this->assertTrue($containerBuilder->hasDefinition('lightsaml.own.entity_descriptor_provider'));
        $definition = $containerBuilder->getDefinition('lightsaml.own.entity_descriptor_provider');
        $this->assertEquals(
            ['LightSaml\Provider\EntityDescriptor\FileEntityDescriptorProviderFactory', 'fromEntityDescriptorFile'],
            $definition->getFactory()
        );
        $this->assertCount(1, $definition->getArguments());
        $this->assertEquals($config['lightsaml']['own']['entity_descriptor_provider']['filename'], $definition->getArgument(0));
    }

    public function testSetsOwnEntityDescriptorProviderToCustomAlias()
    {
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension = new LightSamlSymfonyBridgeExtension();
        $config = $this->getDefaultConfig();
        $config['lightsaml']['own']['entity_descriptor_provider']['id'] = $expectedAlias = 'some.factory';

        $extension->load($config, $containerBuilder);

        $this->assertTrue($containerBuilder->hasAlias('lightsaml.own.entity_descriptor_provider'));
        $this->assertEquals($expectedAlias, (string)$containerBuilder->getAlias('lightsaml.own.entity_descriptor_provider'));
    }

    public function testLoadsOwnCredentialStore()
    {
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension = new LightSamlSymfonyBridgeExtension();
        $config = $this->getDefaultConfig();

        $extension->load($config, $containerBuilder);

        $this->assertTrue($containerBuilder->hasDefinition('lightsaml.own.credential_store'));
        $definition = $containerBuilder->getDefinition('lightsaml.own.credential_store');
        $this->assertEquals('LightSaml\Store\Credential\CompositeCredentialStore', $definition->getClass());
    }

    public function testLoadsSystemTimeProvider()
    {
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension = new LightSamlSymfonyBridgeExtension();
        $config = $this->getDefaultConfig();

        $extension->load($config, $containerBuilder);

        $this->assertTrue($containerBuilder->hasDefinition('lightsaml.system.time_provider'));
    }

    public function testLoadsSystemEventDispatcher()
    {
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension = new LightSamlSymfonyBridgeExtension();
        $config = $this->getDefaultConfig();

        $extension->load($config, $containerBuilder);

        $this->assertTrue($containerBuilder->hasDefinition('lightsaml.system.event_dispatcher'));
    }

    public function testLoadsSystemCustomEventDispatcher()
    {
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension = new LightSamlSymfonyBridgeExtension();
        $config = $this->getDefaultConfig();
        $config['lightsaml']['system']['event_dispatcher'] = $expectedAlias = 'some.service';

        $extension->load($config, $containerBuilder);

        $this->assertTrue($containerBuilder->hasAlias('lightsaml.system.event_dispatcher'));
        $this->assertEquals($expectedAlias, (string)$containerBuilder->getAlias('lightsaml.system.event_dispatcher'));
    }

    public function testLoadsSystemLogger()
    {
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension = new LightSamlSymfonyBridgeExtension();
        $config = $this->getDefaultConfig();

        $extension->load($config, $containerBuilder);

        $this->assertTrue($containerBuilder->hasAlias('lightsaml.system.logger'));
    }

    public function testLoadsSystemCustomLogger()
    {
        $containerBuilder = new ContainerBuilder(new ParameterBag());
        $extension = new LightSamlSymfonyBridgeExtension();
        $config = $this->getDefaultConfig();
        $config['lightsaml']['system']['logger'] = $expectedAlias = 'some.service';

        $extension->load($config, $containerBuilder);

        $this->assertTrue($containerBuilder->hasAlias('lightsaml.system.logger'));
        $this->assertEquals($expectedAlias, (string)$containerBuilder->getAlias('lightsaml.system.logger'));
    }

    private function getDefaultConfig()
    {
        return [
            'lightsaml' => [
                'own' => [
                    'entity_id' => 'http://localhost/symfony-bridge',
                ]
            ]
        ];
    }
}

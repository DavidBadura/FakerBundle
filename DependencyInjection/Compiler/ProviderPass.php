<?php

namespace DavidBadura\FakerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 *
 * @author David Badura <d.badura@gmx.de>
 */
class ProviderPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('davidbadura_faker.faker')) {
            return;
        }

        foreach ($container->findTaggedServiceIds('davidbadura_faker.provider') as $id => $attributes) {
            $container->getDefinition('davidbadura_faker.faker')->addMethodCall('addProvider', array(new Reference($id)));
        }
    }

}

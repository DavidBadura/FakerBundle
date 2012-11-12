<?php

namespace DavidBadura\FakerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * FakerBundle configuration structure.
 *
 * @author David Badura <d.badura@gmx.de>
 */
class Configuration
{
    /**
     * Generates the configuration tree.
     *
     * @return Symfony\Component\Config\Definition\NodeInterface
     */
    public function getConfigTree()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('david_badura_faker', 'array');

        $rootNode
            ->children()
                ->scalarNode('locale')->defaultValue('en_US')->end()
            ->end()
        ;

        return $treeBuilder->buildTree();
    }
}

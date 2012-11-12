<?php

namespace DavidBadura\FakerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use DavidBadura\FakerBundle\DependencyInjection\Compiler\ProviderPass;

/**
 * @author David Badura <d.badura@gmx.de>
 */
class DavidBaduraFakerBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ProviderPass());
    }

}

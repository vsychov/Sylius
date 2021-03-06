<?php

namespace Sylius\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Kamil Kokot <kamil.kokot@lakion.com>
 */
class LazyCacheWarmupPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $this->markServiceAsLazy($container, 'cmf_core.templating.helper');
        $this->markServiceAsLazy($container, 'cmf_create.rdf_type_factory');
    }

    /**
     * @param ContainerBuilder $container
     * @param $id
     */
    private function markServiceAsLazy(ContainerBuilder $container, $id)
    {
        if ($container->hasDefinition($id)) {
            $definition = $container->findDefinition($id);
            $definition->setLazy(true);
        }
    }
}

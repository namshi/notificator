<?php

namespace Namshi\Notificator\Symfony\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class NotificatorHandlerCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('notification.manager')) {
            return;
        }

        $definition = $container->getDefinition('notification.manager');

        $services = $container->findTaggedServiceIds('notification.handler');

        foreach ($services as $service) {
            $definition->addMethodCall('addHandler', array(new Reference($service)));
        }
    }
}
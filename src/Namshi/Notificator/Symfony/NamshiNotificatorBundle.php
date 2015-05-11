<?php

namespace Namshi\Notificator\Symfony;

use Namshi\Notificator\Symfony\DependencyInjection\CompilerPass\NotificatorHandlerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NamshiNotificatorBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new NotificatorHandlerCompilerPass());
    }
}
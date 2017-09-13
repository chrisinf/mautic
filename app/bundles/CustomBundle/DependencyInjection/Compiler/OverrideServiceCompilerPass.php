<?php

/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\CustomBundle\DependencyInjection\Compiler;

use Mautic\CustomBundle\EventListener\GlobalEmailListener;
use Mautic\CustomBundle\Helper\CustomUpdateHelper;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('mautic.helper.update');
        $definition->setClass(CustomUpdateHelper::class);

        $container->register("global_email_listener", GlobalEmailListener::class)
            ->addArgument("@logger")
            ->addTag( "swiftmailer.default.plugin");
    }
}
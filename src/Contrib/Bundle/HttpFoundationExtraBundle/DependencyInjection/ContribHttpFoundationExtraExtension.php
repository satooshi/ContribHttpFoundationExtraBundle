<?php

namespace Contrib\Bundle\HttpFoundationExtraBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

/**
 * ContribHttpFoundationExtraExtension.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class ContribHttpFoundationExtraExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('view.xml');
    }
}

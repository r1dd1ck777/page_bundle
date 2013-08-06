<?php

namespace Rid\Bundle\PageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class RidPageExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $config = $this->handleConfig($config);
        $container->setParameter('rid_page', $config);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    protected function handleConfig(array $config)
    {
        if (!isset($config['template']['layout'])){
            $config['template']['layout'] = '::base.html.twig';
        }

        if (!isset($config['template']['show'])){
            $config['template']['show'] = 'RidPageBundle:Page:show.html.twig';
        }

        if (!isset($config['template']['list'])){
            $config['template']['list'] = 'RidPageBundle:Page:list.html.twig';
        }

        return $config;
    }
}

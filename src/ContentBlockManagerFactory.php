<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace LdcContentBlock;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContentBlockManagerFactory implements FactoryInterface
{
    /**
     * Create and return the content block manager
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return ContentBlockManager
     * @throws Exception\RuntimeException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $configuration = $serviceLocator->get('Config');
        $extconfig = @$configuration['ldc-content-block']['block_loader_configuration'] ?: [];

        /* @var $plugins AbstractPluginManager */
        $plugins = new ContentBlockManager(new Config($extconfig));
        $plugins->setServiceLocator($serviceLocator);

        // Allow overwriting of named blocks
        $plugins->setAllowOverride(true);

        return $plugins;
    }
}

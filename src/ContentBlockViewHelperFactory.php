<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace LdcContentBlock;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContentBlockViewHelperFactory implements FactoryInterface
{
    /**
     * Create and return the content block manager
     *
     * @param  ServiceLocatorInterface $pm
     * @return ContentBlockViewHelper
     * @throws Exception\RuntimeException
     */
    public function createService(ServiceLocatorInterface $pm)
    {
        $serviceLocator = $pm instanceof AbstractPluginManager ? $pm->getServiceLocator() : $pm;
        $service = $serviceLocator->get('ldc-content-block_service');

        $svc = new ContentBlockViewHelper($service);
        return $svc;
    }
}

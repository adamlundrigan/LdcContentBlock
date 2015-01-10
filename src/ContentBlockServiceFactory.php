<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace LdcContentBlock;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContentBlockServiceFactory implements FactoryInterface
{
    /**
     * Create and return the content block manager
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return ContentBlockService
     * @throws Exception\RuntimeException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('ldc-content-block_module-options');
        $manager = $serviceLocator->get('ldc-content-block_manager');

        $svc = new ContentBlockService($options, $manager);
        return $svc;
    }
}

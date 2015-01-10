<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace LdcContentBlockTest;

use LdcContentBlock\ContentBlockServiceFactory;
use Zend\ServiceManager\ServiceManager;

class ContentBlockServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $mockOptions = \Mockery::mock('LdcContentBlock\Options\ModuleOptions');
        $mockManager = \Mockery::mock('LdcContentBlock\ContentBlockManager');

        $serviceManager = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceManager->shouldReceive('get')->with('ldc-content-block_module-options')->once()->andReturn($mockOptions);
        $serviceManager->shouldReceive('get')->with('ldc-content-block_manager')->once()->andReturn($mockManager);

        $factory = new ContentBlockServiceFactory();
        $svc = $factory->createService($serviceManager);

        $this->assertInstanceOf('LdcContentBlock\ContentBlockService', $svc);
    }
}

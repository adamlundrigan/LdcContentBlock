<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace LdcContentBlockTest;

use LdcContentBlock\ContentBlockViewHelperFactory;

class ContentBlockViewHelperFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $mockService = \Mockery::mock('LdcContentBlock\ContentBlockService');

        $serviceManager = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceManager->shouldReceive('get')->with('ldc-content-block_service')->once()->andReturn($mockService);

        $factory = new ContentBlockViewHelperFactory();
        $svc = $factory->createService($serviceManager);

        $this->assertInstanceOf('LdcContentBlock\ContentBlockViewHelper', $svc);
    }
}

<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace LdcContentBlockTest;

use LdcContentBlock\ContentBlockManagerFactory;
use Zend\ServiceManager\ServiceManager;

class ContentBlockManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateServiceWithNoConfiguration()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('Config', []);

        $factory = new ContentBlockManagerFactory();
        $svc = $factory->createService($serviceManager);

        $this->assertInstanceOf('LdcContentBlock\ContentBlockManager', $svc);
        $this->assertCount(0, $svc->getCanonicalNames());
    }

    public function testCreateServiceWithConfiguration()
    {
        $mock = \Mockery::mock('Zend\View\Model\ModelInterface');

        $serviceManager = new ServiceManager();
        $serviceManager->setService('Config', [
            'ldc-content-block' => [
                'block_loader_configuration' => [
                    'factories' => [
                        'testext' => function ($sm) use ($mock) {
                            return $mock;
                        },
                    ],
                ],
            ],
        ]);

        $factory = new ContentBlockManagerFactory();
        $svc = $factory->createService($serviceManager);

        $this->assertInstanceOf('LdcContentBlock\ContentBlockManager', $svc);
        $this->assertCount(1, $svc->getCanonicalNames());
        $this->assertSame($mock, $svc->get('testext'));
    }
}

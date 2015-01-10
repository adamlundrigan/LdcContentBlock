<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace LdcContentBlockTest\Options;

class ModuleOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateServiceWithNoConfiguration()
    {
        $serviceManager = new \Zend\ServiceManager\ServiceManager();
        $serviceManager->setService('Config', array());

        $factory = new \LdcContentBlock\Options\ModuleOptionsFactory();
        $svc = $factory->createService($serviceManager);

        $this->assertInstanceOf('LdcContentBlock\Options\ModuleOptions', $svc);
    }

    public function testCreateServiceWithoutConfiguration()
    {
        $serviceManager = new \Zend\ServiceManager\ServiceManager();
        $serviceManager->setService('Config', []);

        $factory = new \LdcContentBlock\Options\ModuleOptionsFactory();
        $svc = $factory->createService($serviceManager);

        $this->assertInstanceOf('LdcContentBlock\Options\ModuleOptions', $svc);
        $this->assertCount(0, $svc->getBlocks());
    }

    public function testCreateServiceWithConfiguration()
    {
        $serviceManager = new \Zend\ServiceManager\ServiceManager();
        $serviceManager->setService('Config', [
            'ldc-content-block' => [
                'blocks' => [
                    'test-two' => [
                        'view_model_five',
                        'view_model_four',
                    ],
                ],
            ],
        ]);

        $factory = new \LdcContentBlock\Options\ModuleOptionsFactory();
        $svc = $factory->createService($serviceManager);

        $this->assertInstanceOf('LdcContentBlock\Options\ModuleOptions', $svc);
        $this->assertCount(1, $svc->getBlocks());
        $this->assertArrayHasKey('test-two', $svc->getBlocks());
    }
}

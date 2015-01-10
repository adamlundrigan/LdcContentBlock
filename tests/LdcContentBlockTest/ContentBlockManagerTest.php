<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace LdcContentBlockTest;

use LdcContentBlock\ContentBlockManager;

class ContentBlockManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testAcceptsOnlyValidExtensions()
    {
        $mock = \Mockery::mock('Zend\View\Model\ModelInterface');

        $manager = new ContentBlockManager();
        $this->assertNull($manager->validatePlugin($mock));

        $this->setExpectedException('LdcContentBlock\Exception\InvalidContentBlockException');
        $manager->validatePlugin(new \stdClass());
    }

    public function testRegisteredExtensions()
    {
        $mock = \Mockery::mock('Zend\View\Model\ModelInterface');

        $manager = new ContentBlockManager(new \Zend\ServiceManager\Config([
            'services' => [
                'test' => $mock,
            ],
        ]));

        $this->assertEquals(['test'], $manager->getRegisteredContentBlocks());
        $this->assertSame($mock, $manager->get('test'));
    }
}

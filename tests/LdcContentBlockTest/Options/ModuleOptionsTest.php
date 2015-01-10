<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace LdcContentBlockTest\Options;

use LdcContentBlock\Options\ModuleOptions as Options;

class ModuleOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Options $options
     */
    protected $options;

    public function setUp()
    {
        $this->options = new Options();
    }

    public function testInstantiation()
    {
        $this->assertInstanceOf('LdcContentBlock\Options\ModuleOptions', $this->options);
    }

    public function testBlocksIgnoresEmptyArray()
    {
        $this->options->setBlocks([]);
        $this->assertCount(0, $this->options->getBlocks());
    }

    public function testBlocks()
    {
        $blocks = [
            'test-one' => [
                'view_model_one' => -9999,
                'view_model_two' => 9999,
                'view_model_three',
            ],
            'test-two' => [
                'view_model_five',
                'view_model_four',
            ],
            'test-three' => [],
        ];

        $this->options->setBlocks($blocks);
        $this->assertCount(3, $this->options->getBlocks());

        $this->assertArrayHasKey('test-one', $this->options->getBlocks());
        $this->assertInstanceOf('Zend\Stdlib\PriorityList', $this->options->getBlocks()['test-one']);
        $this->assertCount(3, $this->options->getBlocks()['test-one']);
        // Check that priorities are respected
        $expectedOrder = ['view_model_two', 'view_model_three', 'view_model_one'];
        foreach ( $this->options->getBlocks()['test-one'] as $key => $item ) {
            $this->assertEquals(array_shift($expectedOrder), $key);
        }

        $this->assertArrayHasKey('test-two', $this->options->getBlocks());
        $this->assertInstanceOf('Zend\Stdlib\PriorityList', $this->options->getBlocks()['test-two']);
        $this->assertCount(2, $this->options->getBlocks()['test-two']);
        // Check that priorities are respected
        $expectedOrderTwo = ['view_model_four', 'view_model_five'];
        foreach ( $this->options->getBlocks()['test-two'] as $key => $item ) {
            $this->assertEquals(array_shift($expectedOrderTwo), $key);
        }

        $this->assertArrayHasKey('test-three', $this->options->getBlocks());
        $this->assertInstanceOf('Zend\Stdlib\PriorityList', $this->options->getBlocks()['test-three']);
        $this->assertCount(0, $this->options->getBlocks()['test-three']);

        $this->assertTrue($this->options->hasBlock('test-one'));
        $this->assertFalse($this->options->hasBlock('test-noexist'));

        $this->assertSame($this->options->getBlocks()['test-one'], $this->options->getBlock('test-one'));
    }

    public function testBlocksOverwritesPreviousSettings()
    {
        $blocks = [
            'test-three' => [

            ],
        ];

        $this->testBlocks();
        $this->options->setBlocks($blocks);
        $this->assertCount(1, $this->options->getBlocks());
        $this->assertArrayHasKey('test-three', $this->options->getBlocks());
        $this->assertInstanceOf('Zend\Stdlib\PriorityList', $this->options->getBlocks()['test-three']);
    }
}

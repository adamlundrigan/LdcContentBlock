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
use LdcContentBlock\ContentBlockService;
use LdcContentBlock\Options\ModuleOptions;
use Zend\View\Model\ViewModel;

class ContentBlockServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @var ContentBlockService
     */
    protected $service;

    public function setUp()
    {
        $this->options = new ModuleOptions();
        $this->manager = new ContentBlockManager();

        $this->service = new ContentBlockService($this->options, $this->manager);
    }

    public function testAddViewModel()
    {
        $vm = new ViewModel();
        $this->service->registerViewModel('test_view_model', $vm);
        $this->assertTrue($this->manager->has('test_view_model'));
        $this->assertSame($vm, $this->manager->get('test_view_model'));
    }

    public function testGetRegisteredViewModelsForBlockWhenBlockNotRegistered()
    {
        $this->setExpectedException('LdcContentBlock\Exception\ContentBlockNotFoundException');
        $this->service->getRegisteredViewModelsForBlock('test_block');
    }

    public function testGetRegisteredViewModelsForBlockWhenBlockIsRegisteredButEmpty()
    {
        $this->options->setBlocks(['test_block' => []]);
        $this->assertEmpty($this->service->getRegisteredViewModelsForBlock('test_block'));
    }

    public function testGetRegisteredViewModelsForBlockWhenBlockIsRegistered()
    {
        $this->options->setBlocks([
            'test_block' => [
                'view_model_one',
            ],
        ]);
        $vm = new ViewModel();
        $this->service->registerViewModel('view_model_one', $vm);

        $models = $this->service->getRegisteredViewModelsForBlock('test_block');
        $this->assertArrayHasKey('view_model_one', $models);
        $this->assertSame($vm, $models['view_model_one']);
    }
}

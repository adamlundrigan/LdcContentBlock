<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace LdcContentBlockTest;

use LdcContentBlock\ContentBlockViewHelper;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;

class ContentBlockViewHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var \Zend\View\Renderer\RendererInterface;
     */
    protected $view;

    public function setUp()
    {
        $this->service = \Mockery::mock('LdcContentBlock\ContentBlockService');

        $this->view = new PhpRenderer();

        $this->helper = new ContentBlockViewHelper($this->service);
        $this->helper->setView($this->view);
    }

    public function testInvokeWhenBlockIsNotRegistered()
    {
        $this->service->shouldReceive('getRegisteredViewModelsForBlock')->with('not_a_block')->andReturnUsing(function ($arg) {
            throw new \LdcContentBlock\Exception\ContentBlockNotFoundException();
        });

        $this->assertEmpty($this->helper->__invoke('not_a_block'));
    }

    public function testInvokeWhenBlockIsRegisteredButEmpty()
    {
        $this->service->shouldReceive('getRegisteredViewModelsForBlock')->with('a_block')->andReturn([]);
        $this->assertEmpty($this->helper->__invoke('a_block'));
    }

    public function testInvokeWhenBlockIsRegisteredAndHasViewModels()
    {
        $this->view->setResolver(
            new \Zend\View\Resolver\TemplateMapResolver([
                'my_first_block_tpl'  => __DIR__ . '/TestAssets/view/my_first_block_tpl.phtml',
                'my_second_block_tpl' => __DIR__ . '/TestAssets/view/my_second_block_tpl.phtml',
            ])
        );

        $this->service->shouldReceive('getRegisteredViewModelsForBlock')->with('a_block')->andReturn([
            'my_first_block'  => (new ViewModel())->setTemplate('my_first_block_tpl'),
            'my_second_block' => (new ViewModel())->setTemplate('my_second_block_tpl'),
        ]);
        $this->assertEquals('Block ABlock B', $this->helper->__invoke('a_block'));
    }

    public function testInvokePassesContextToViewModels()
    {
        $this->view->setResolver(
            new \Zend\View\Resolver\TemplateMapResolver([
                'context_aware_block'  => __DIR__ . '/TestAssets/view/context_aware_block.phtml',
            ])
        );

        $vm = new ViewModel();
        $vm->setVariables([
            'foo'     => '123',
            'message' => 'override!',
        ]);
        $vm->setTemplate('context_aware_block');

        $this->service->shouldReceive('getRegisteredViewModelsForBlock')->with('a_block')->andReturn([
            'my_first_block'  => $vm,
        ]);
        $this->assertEquals('FooBar@123', $this->helper->__invoke('a_block', ['message' => 'FooBar']));
    }
}

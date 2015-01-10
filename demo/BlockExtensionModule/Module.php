<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace BlockExtensionModule;

use Zend\Mvc\MvcEvent;

use Zend\View\Model\ViewModel;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $service = $e->getApplication()->getServiceManager()->get('ldc-content-block_service');
        
        $vm = new ViewModel();        
        $vm->setTemplate('myproject_jumbotron_block_one');
        $service->registerViewModel('myproject_jumbotron_block_one', $vm);
        
        $vm = new ViewModel();        
        $vm->setTemplate('myproject_infoboxes_block_two');
        $service->registerViewModel('myproject_infoboxes_block_two', $vm);
        
        $vm = new ViewModel();        
        $vm->setTemplate('myproject_infoboxes_block_three');
        $service->registerViewModel('myproject_infoboxes_block_three', $vm);
        
        $vm = new ViewModel();        
        $vm->setTemplate('myproject_infoboxes_block_four');
        $service->registerViewModel('myproject_infoboxes_block_four', $vm);
    }
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src',
                ),
            ),
        );
    }

    public function getConfig()
    {
        return [
            'ldc-content-block' => [
                'blocks' => [
                    'jumbotron' => [
                        'myproject_jumbotron_block_one' => -9999,
                    ],
                    'infoboxes' => [
                        'myproject_infoboxes_block_two',
                        'myproject_infoboxes_block_three' => -9999,
                        'myproject_infoboxes_block_four' => 9999,
                    ],
                ],
            ],
            'view_manager' => [
                'template_path_stack' => array(
                    __DIR__ . '/view',
                ),
            ]
        ];
    }
}

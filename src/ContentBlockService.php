<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace LdcContentBlock;

use LdcContentBlock\Options\ModuleOptions;
use Zend\Stdlib\PriorityList;
use Zend\View\Model\ModelInterface;

class ContentBlockService
{
    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @var ContentBlockManager
     */
    protected $manager;

    public function __construct(ModuleOptions $options, ContentBlockManager $mgr)
    {
        $this->options = $options;
        $this->manager = $mgr;
    }

    public function registerViewModel($name, ModelInterface $vm)
    {
        $this->manager->setService($name, $vm);
        return true;
    }

    /**
     *
     * @param type $name
     * @return ModelInterface
     */
    public function getViewModel($name)
    {
        return $this->manager->get($name);
    }

    public function getRegisteredViewModelsForBlock($block)
    {
        $block = $this->options->getBlock($block);
        if ( ! $block instanceof PriorityList ) {
            throw new Exception\ContentBlockNotFoundException($block);
        }

        $result = array();
        foreach ( $block as $name => $data) {
            $result[$name] = $this->getViewModel($name);
        }
        return $result;
    }
}

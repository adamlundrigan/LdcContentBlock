<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace LdcContentBlock;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\View\Model\ModelInterface;

class ContentBlockManager extends AbstractPluginManager
{
    /**
     * Return a list of registered content blocks
     *
     * @return array
     */
    public function getRegisteredContentBlocks()
    {
        return array_unique(array_values($this->getCanonicalNames()));
    }

    /**
     * Validate the plugin
     *
     * Checks that the helper loaded is an instance of ModelInterface.
     *
     * @param  mixed                            $plugin
     * @return void
     * @throws Exception\InvalidHelperException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof ModelInterface) {
            // we're okay
            return;
        }
        throw new Exception\InvalidContentBlockException(sprintf(
            'Plugin of type %s is invalid; must implement Zend\View\Model\ModelInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin))
        ));
    }
}

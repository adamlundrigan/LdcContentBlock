<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace LdcContentBlock\Options;

use Zend\Stdlib\AbstractOptions;
use Zend\Stdlib\PriorityList;

class ModuleOptions extends AbstractOptions
{
    /**
     * Turn off strict options mode
     */
    protected $__strictMode__ = false;

    /**
     * Content Block configuration
     *
     * @var array
     */
    protected $blocks = array();

    public function setBlocks(array $blocks)
    {
        $this->blocks = [];

        foreach ( $blocks as $block => $contents ) {
            $this->blocks[$block] = new PriorityList();

            if (!is_array($contents) || empty($contents)) {
                continue;
            }
            foreach ( $contents as $alias => $priority ) {
                is_numeric($alias)
                    ? $this->blocks[$block]->insert($priority, null)
                    : $this->blocks[$block]->insert($alias, null, $priority);
            }
        }
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function hasBlock($name)
    {
        return isset($this->blocks[$name]);
    }

    public function getBlock($name)
    {
        return $this->hasBlock($name) ? $this->blocks[$name] : null;
    }
}

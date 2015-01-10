<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace LdcContentBlock;

use Zend\View\Helper\AbstractHelper;

class ContentBlockViewHelper extends AbstractHelper
{
    /**
     * @var ContentBlockService
     */
    protected $service;

    public function __construct(ContentBlockService $svc)
    {
        $this->service = $svc;
    }

    public function __invoke($name, $context = array())
    {
        try {
            $models = $this->service->getRegisteredViewModelsForBlock($name);
            $output = "";
            foreach ( $models as $model ) {
                $model->setVariables($context);
                $output .= $this->getView()->render($model);
            }
            return $output;
        } catch (Exception\ContentBlockNotFoundException $ex) {
            return '';
        }
    }
}

<?php
/**
 * LdcContentBlock
 *
 * @link      http://github.com/adamlundrigan/LdcContentBlock for the canonical source repository
 * @copyright Copyright (c) 2014 Adam Lundrigan & Contributors
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return [
    'service_manager' => [
        'factories' => [
            'ldc-content-block_module-options' => 'LdcContentBlock\Options\ModuleOptionsFactory',
            'ldc-content-block_manager'        => 'LdcContentBlock\ContentBlockManagerFactory',
            'ldc-content-block_service'        => 'LdcContentBlock\ContentBlockServiceFactory',
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'renderContentBlock' => 'LdcContentBlock\ContentBlockViewHelperFactory',
        ],
    ],
];

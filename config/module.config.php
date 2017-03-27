<?php
/**
 * Zend framework BarLogger for developer tools
 *
 * @link        https://github.com/renat-magadiev/zf3-bar-logger
 * @copyright   Copyright (c) 2017 Renat MAGADIEV (https://www.magadiev.cz)
 * @license     MIT License https://github.com/renat-magadiev/zf3-bar-logger/blob/master/LICENSE
 */

namespace BarLogger;

use BarLogger\Collector\DebugCollector;

return array(
    'service_manager' => array(
        'invokables' => array(
            'BarLogger\DebugCollector' => DebugCollector::class,
        ),
    ),

    'view_manager' => array(
        'template_map' => array(
            'debug-collector' => __DIR__ . '/../view/bar-logger/render.phtml',
        ),
    ),

    'zenddevelopertools' => array(
        'profiler' => array(
            'collectors' => array(
                'bar_logger' => 'BarLogger\DebugCollector',
            ),
        ),
        'toolbar' => array(
            'entries' => array(
                'bar_logger' => 'debug-collector',
            ),
        ),
    ),
);

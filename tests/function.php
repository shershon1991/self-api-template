<?php

namespace Wm\Common\Util;

use DI\ContainerBuilder;
use function DI\get;

function container()
{
    static $container = null;
    if (empty($container)) {
        $container = ContainerBuilder::buildDevContainer();
        $list = Support::listDefaultDependent();
        array_map(function ($key, $value) use ($container) {
            $container->set($key, get($value));
        }, array_keys($list), array_values($list));
    }
    return $container;
}

function config($name, $default = null)
{
    static $cfg;
    if (is_null($cfg)) {
        $cfg = initConfig();
    }
    return data_get($cfg, $name, $default);
}

function initConfig()
{
    return [
        'api' => [
            'course_center' => [
                'base_url' => 'http://test-internal-course-center.weimiaocaishang.com',
                'timeout' => 1,
            ],
            'study_center' => [
                'base_url' => 'http://test-internal-study-center.weimiaocaishang.com',
                'timeout' => 1,
            ],
            'subject_library' => [
                'base_url' => 'http://test-internal-subject-api.weimiaocaishang.com',
                'timeout' => 1,
            ],
        ],
    ];
}

<?php
/**
 * Simple automated command bus
 *
 * @link      https://github.com/hiqdev/yii2-autobus
 * @package   yii2-autobus
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

return [
    'id' => 'tests',
    'basePath' => dirname(__DIR__),
    'container' => [
        'singletons' => [
            'first-bus' => [
                '__class' => \hiqdev\yii2\autobus\components\SimpleAutoBus::class,
                '__construct()' => [
                    [
                        'first' => [
                            '__class' => \hiqdev\yii2\autobus\tests\unit\DumbCommand::class,
                            '__construct()' => ['first'],
                        ],
                        'joinWithSpace' => [
                            '__class' => \hiqdev\yii2\autobus\tests\unit\JoinCommand::class,
                            '__construct()' => [' '],
                        ],
                        'joinWithComma' => [
                            '__class' => \hiqdev\yii2\autobus\tests\unit\JoinCommand::class,
                            '__construct()' => [','],
                        ],
                    ],
                ],
            ],
            'other-bus' => [
                '__class' => \hiqdev\yii2\autobus\components\SimpleAutoBus::class,
                '__construct()' => [
                    [
                        'second' => [
                            '__class' => \hiqdev\yii2\autobus\tests\unit\DumbCommand::class,
                            '__construct()' => ['second'],
                        ],
                    ],
                ],
            ],
        ],
    ],
];

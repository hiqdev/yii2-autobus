<?php
/**
 * Simple automated command bus
 *
 * @link      https://github.com/hiqdev/yii2-autobus
 * @package   yii2-autobus
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

return [
    'components' => [
        'autobus' => [
            'class' => \hiqdev\yii2\autobus\components\BranchedAutoBus::class,
        ],
        'commandBus' => [
            'class' => \hiqdev\yii2\autobus\components\CommandBusInterface::class,
            'middlewares' => [
                'load' => \hiqdev\yii2\autobus\bus\LoadMiddleware::class,
            ],
        ],
    ],
    'container' => [
        'definitions' => [
            \hiqdev\yii2\autobus\components\CommandFactoryInterface::class => [
                'class' => \hiqdev\yii2\autobus\components\SimpleCommandFactory::class,
            ],
            \hiqdev\yii2\autobus\components\CommandBusInterface::class => [
                [
                    'class' => \hiqdev\yii2\autobus\components\TacticianCommandBus::class,
                ],
                [
                    \yii\di\Instance::of(\my\CommandHandlerMiddleware::class),
                ],
            ],
            \my\CommandHandlerMiddleware::class => [
                [
                    'class' => \League\Tactician\Handler\CommandHandlerMiddleware::class,
                ],
                [
                    \yii\di\Instance::of(\League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor::class),
                    \yii\di\Instance::of(\hiqdev\yii2\autobus\bus\NearbyHandlerLocator::class),
                    \yii\di\Instance::of(\League\Tactician\Handler\MethodNameInflector\HandleInflector::class),
                ],
            ],
        ],
    ],
];

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
// Should not be used.
//    'components' => [
//        'autobus' => [
//            'class' => \hiqdev\yii2\autobus\components\BranchedAutoBus::class,
//        ],
//        'commandBus' => [
//            'class' => \hiqdev\yii2\autobus\components\CommandBusInterface::class,
//            'middlewares' => [
//                'load' => \hiqdev\yii2\autobus\bus\LoadMiddleware::class,
//            ],
//        ],
//    ],
    'container' => [
        'definitions' => [
            \hiqdev\yii2\autobus\components\CommandBusInterface::class => [
                [
                    '__class' => \hiqdev\yii2\autobus\components\TacticianCommandBus::class,
                ],
                [
                    new \yii\di\Reference(\my\CommandHandlerMiddleware::class),
                ],
            ],
            \my\CommandHandlerMiddleware::class => [
                [
                    '__class' => \League\Tactician\Handler\CommandHandlerMiddleware::class,
                ],
                [
                    new \yii\di\Reference(\League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor::class),
                    new \yii\di\Reference(\hiqdev\yii2\autobus\bus\NearbyHandlerLocator::class),
                    new \yii\di\Reference(\League\Tactician\Handler\MethodNameInflector\HandleInflector::class),
                ],
            ],
        ],
        'singletons' => [
            \hiqdev\yii2\autobus\components\CommandFactoryInterface::class => \hiqdev\yii2\autobus\components\SimpleCommandFactory::class,
            \hiqdev\yii2\autobus\components\AutoBusFactoryInterface::class => [
                '__class' => \hiqdev\yii2\autobus\components\ContainerAutoBusFactory::class,
            ],
        ],
    ],
];

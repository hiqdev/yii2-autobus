<?php
/**
 * Simple automated command bus
 *
 * @link      https://github.com/hiqdev/yii2-autobus
 * @package   yii2-autobus
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

$definitions = [
    \hiqdev\yii2\autobus\components\CommandBusInterface::class => [
        '__class' => \hiqdev\yii2\autobus\components\TacticianCommandBus::class,
        '__construct()' => [
            \yii\di\Reference::to(\my\CommandHandlerMiddleware::class),
        ],
    ],
    \my\CommandHandlerMiddleware::class => [
        '__class' => \League\Tactician\Handler\CommandHandlerMiddleware::class,
        '__construct()' => [
            \yii\di\Reference::to(\League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor::class),
            \yii\di\Reference::to(\hiqdev\yii2\autobus\bus\NearbyHandlerLocator::class),
            \yii\di\Reference::to(\League\Tactician\Handler\MethodNameInflector\HandleInflector::class),
        ],
    ],
];

$singletons = [
    \hiqdev\yii2\autobus\components\CommandFactoryInterface::class => [
        '__class' => \hiqdev\yii2\autobus\components\SimpleCommandFactory::class,
    ],
    \hiqdev\yii2\autobus\components\AutoBusFactoryInterface::class => [
        '__class' => \hiqdev\yii2\autobus\components\ContainerAutoBusFactory::class,
    ],
];

return class_exists('Yii')
    ? ['container' => ['definitions' => $definitions, 'singletons' => $singletons]]
    : [array_merge($singletons, ['factory' => ['__construct' => ['definitions' => $definitions]]])]
;

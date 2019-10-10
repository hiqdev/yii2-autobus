<?php
/**
 * Simple automated command bus
 *
 * @link      https://github.com/hiqdev/yii2-autobus
 * @package   yii2-autobus
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

use hiqdev\yii\compat\yii;

$definitions = [
    \hiqdev\yii2\autobus\components\CommandBusInterface::class => [
        yii::classKey() => \hiqdev\yii2\autobus\components\TacticianCommandBus::class,
        '__construct()' => [
            \hiqdev\yii2\autobus\yii::referenceTo(\my\CommandHandlerMiddleware::class),
        ],
    ],
    \my\CommandHandlerMiddleware::class => [
        yii::classKey() => \League\Tactician\Handler\CommandHandlerMiddleware::class,
        '__construct()' => [
            \hiqdev\yii2\autobus\yii::referenceTo(\League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor::class),
            \hiqdev\yii2\autobus\yii::referenceTo(\hiqdev\yii2\autobus\bus\NearbyHandlerLocator::class),
            \hiqdev\yii2\autobus\yii::referenceTo(\League\Tactician\Handler\MethodNameInflector\HandleInflector::class),
        ],
    ],
];

$singletons = [
    \hiqdev\yii2\autobus\components\CommandFactoryInterface::class => [
        yii::classKey() => \hiqdev\yii2\autobus\components\SimpleCommandFactory::class,
    ],
    \hiqdev\yii2\autobus\components\AutoBusFactoryInterface::class => [
        yii::classKey() => \hiqdev\yii2\autobus\components\ContainerAutoBusFactory::class,
    ],
];

return class_exists('Yii')
    ? ['container' => ['definitions' => $definitions, 'singletons' => $singletons]]
    : array_merge($singletons, ['factory' => ['__construct' => ['definitions' => $definitions]]])
;

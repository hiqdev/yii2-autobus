<?php

return [
    'components' => [
        'autobus' => [
            'class' => \hiqdev\yii2\autobus\AutoBus::class,
        ],
        'commandBus' => [
            'class' => \hiqdev\yii2\autobus\bus\CommandBusInterface::class,
            'middlewares' => [
                'load' => \hiqdev\yii2\autobus\bus\LoadMiddleware::class,
            ],
        ],
    ],
    'container' => [
        'definitions' => [
            \hiqdev\yii2\autobus\bus\CommandBusInterface::class => [
                [
                    'class' => \hiapi\components\TacticianCommandBus::class,
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
                    \yii\di\Instance::of(\League\Tactician\Handler\MethodNameInflector\HandleInflector::class)
                ],
            ],
        ],
    ],
];

<?php

namespace hiqdev\yii2\autobus\components;

class SimpleCommandFactory implements CommandFactoryInterface
{
    public function create($config, array $args)
    {
        if (is_string($config)) {
            $config = ['class' => $config];
        }
        if (!is_array($config) || empty($config['class'])) {
            throw new \Exception('bad command config');
        }
        unset($args['class']);

        return Yii::createObject(array_merge($config, $args));
    }
}

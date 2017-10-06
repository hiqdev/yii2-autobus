<?php

namespace hiqdev\yii2\autobus\components;

interface CommandFactoryInterface
{
    public function create($config, array $args);
}

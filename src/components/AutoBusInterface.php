<?php

namespace hiqdev\yii2\autobus\components;

interface AutoBusInterface extends CommandBusInterface
{
    public function hasCommand($name);

    public function runCommand($name, $args);
}

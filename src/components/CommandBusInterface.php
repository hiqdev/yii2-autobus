<?php

namespace hiqdev\yii2\autobus\components;

interface CommandBusInterface
{
    public function handle($command);
}

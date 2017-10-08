<?php
/**
 * Simple automated command bus
 *
 * @link      https://github.com/hiqdev/yii2-autobus
 * @package   yii2-autobus
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

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

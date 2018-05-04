<?php
/**
 * Simple automated command bus
 *
 * @link      https://github.com/hiqdev/yii2-autobus
 * @package   yii2-autobus
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\autobus\components;

/**
 * AutoBus Factory Interface.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
interface AutoBusFactoryInterface
{
    public function get($name): AutoBusInterface;
}

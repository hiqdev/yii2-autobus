<?php
/**
 * Simple automated command bus
 *
 * @link      https://github.com/hiqdev/yii2-autobus
 * @package   yii2-autobus
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\autobus\bus;

use League\Tactician\Handler\Locator\HandlerLocator;

/**
 * Class SameHandlerLocator.
 */
class SameHandlerLocator implements HandlerLocator
{
    /**
     * @var mixed
     */
    private $handler;

    public function __construct($handler)
    {
        $this->handler = $handler;
    }

    public function getHandlerForCommand($class)
    {
        return $this->handler;
    }
}

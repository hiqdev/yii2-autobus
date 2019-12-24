<?php
/**
 * Simple automated command bus
 *
 * @link      https://github.com/hiqdev/yii2-autobus
 * @package   yii2-autobus
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\autobus\tests\unit;

class JoinHandler
{
    /**
     * @return string
     */
    public function handle(JoinCommand $command)
    {
        return implode($command->getDelimiter(), $command->getArgs());
    }
}

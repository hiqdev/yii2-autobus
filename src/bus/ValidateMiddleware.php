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

use League\Tactician\Middleware;
use yii\base\Model;

/**
 * Class ValidateMiddleware.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class ValidateMiddleware implements Middleware
{
    /**
     * @param object|Model $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        if (!$command->validate()) {
            // TODO: specific exception
            throw new \InvalidArgumentException(implode(', ', $command->getFirstErrors()));
        }

        return $next($command);
    }
}

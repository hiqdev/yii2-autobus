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
use Yii;

class LoadMiddleware implements Middleware
{
    public function execute($command, callable $next)
    {
        $error = $command->loadFromRequest(Yii::$app->request);
        if ($error) {
            throw new \Exception('failed load command, error: ' . var_export($error, true));
        }

        return $next($command);
    }
}

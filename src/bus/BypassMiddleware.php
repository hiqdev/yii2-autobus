<?php


namespace hiqdev\yii2\autobus\bus;

use League\Tactician\Middleware;

/**
 * Class BypassMiddleware - simply does nothing
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class BypassMiddleware implements Middleware
{
    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        return $next($command);
    }
}

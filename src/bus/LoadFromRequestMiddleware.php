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
use yii\web\Request;

/**
 * Class LoadFromRequestMiddleware takes data from POST or (if it is empty) from GET request,
 * trims all the values and tries to load them to the command.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class LoadFromRequestMiddleware implements Middleware
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param object|Model $command
     * @param callable $next
     * @return mixed
     * @throws \Exception
     */
    public function execute($command, callable $next)
    {
        if (!$command instanceof Model) {
            // TODO: specific exception
            throw new \Exception('This middleware can load only commands of Model class');
        }

        $data = array_map('trim', $this->request->post() ?: $this->request->get());
        $successLoad = $command->load($data, '');
        if (!$successLoad) {
            // TODO: specific exception
            throw new \Exception('Failed to load command');
        }

        return $next($command);
    }
}

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

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Middleware;
use yii\di\Container;

class TacticianCommandBus extends \yii\base\Component implements CommandBusInterface
{
    /**
     * @var Middleware[]
     */
    protected $middlewares = [];

    /**
     * @var Middleware
     */
    protected $defaultHandler;

    /**
     * @var CommandBus
     */
    protected $realCommandBus;
    /**
     * @var Container
     */
    private $di;

    public function __construct(Middleware $defaultHandler, Container $di, array $config = [])
    {
        parent::__construct($config);
        $this->di = $di;
        $this->defaultHandler = $defaultHandler;
        $this->realCommandBus = new CommandBus($this->getMiddlewares());
    }

    public function handle($command)
    {
        return $this->realCommandBus->handle($command);
    }

    public function getMiddlewares()
    {
        $this->middlewares = $this->prepareMiddlewares($this->middlewares);

        return $this->middlewares;
    }

    protected function prepareMiddlewares($middlewares)
    {
        foreach ($middlewares as &$middleware) {
            if (!is_object($middleware)) {
                $middleware = $this->di->get($middleware);
            }
        }

        if (!$this->containsHandler($middlewares)) {
            $middlewares[] = $this->defaultHandler;
        }

        return $middlewares;
    }

    public function setMiddlewares($middlewares)
    {
        $this->middlewares = $middlewares;
    }

    protected function containsHandler($middlewares)
    {
        foreach ($middlewares as $middleware) {
            if ($middleware instanceof CommandHandlerMiddleware) {
                return true;
            }
        }

        return false;
    }
}

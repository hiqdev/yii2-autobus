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
use ReflectionClass;
use yii\base\UnknownClassException;
use yii\di\Container;

/**
 * Class NearbyHandlerLocator
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
class NearbyHandlerLocator implements HandlerLocator
{
    /**
     * @var Container
     */
    private $di;

    public function __construct(Container $di)
    {
        $this->di = $di;
    }

    public function getHandlerForCommand($class)
    {
        $reflector = new ReflectionClass($class);
        $dir = dirname($reflector->getFileName());

        $commandName = $reflector->getShortName();
        $handlerName = substr($commandName, 0, strrpos($commandName, 'Command')) . 'Handler';

        $path = $dir . DIRECTORY_SEPARATOR . $handlerName . '.php';
        if (!is_file($path)) {
            throw new UnknownClassException('Class "' . $handlerName . '" was not found near to ' . $reflector->getName());
        }

        $className = $reflector->getNamespaceName() . '\\' . $handlerName;

        return $this->di->get($className);
    }
}

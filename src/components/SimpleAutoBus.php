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
 * Class SimpleAutoBus represents simple routing: name -> config.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
final class SimpleAutoBus implements AutoBusInterface
{
    /** @var CommandBusInterface */
    private $bus;

    /** @var CommandFactoryInterface */
    private $factory;

    /** @var array */
    private $commands;

    public function __construct(array $commands = [], CommandBusInterface $bus, CommandFactoryInterface $factory)
    {
        $this->commands = $commands;
        $this->bus = $bus;
        $this->factory = $factory;
    }

    public function hasCommand($name)
    {
        return isset($this->commands[$name]);
    }

    public function getCommandConfig($name)
    {
        if (!$this->hasCommand($name)) {
            throw new WrongCommandException("no command $name");
        }
        return $this->commands[$name];
    }

    public function runCommand($name, $args = [])
    {
        $config = $this->getCommandConfig($name);
        $command = $this->factory->create($config, $args);

        return $this->handle($command);
    }

    public function handle($command)
    {
        return $this->bus->handle($command);
    }
}

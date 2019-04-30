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
 * Class SingleCommandAutoBus represents routing of all incoming commands
 * to a single command class.
 *
 * @author Dmytro Naumenko <d.naumenko.a@gmail.com>
 */
final class SingleCommandAutoBus implements AutoBusInterface
{
    /** @var CommandBusInterface */
    private $bus;

    /** @var CommandFactoryInterface */
    private $factory;

    /** @var array */
    private $commandConfig;

    public function __construct(array $commandConfig, CommandBusInterface $bus, CommandFactoryInterface $factory)
    {
        $this->commandConfig = $commandConfig;
        $this->bus = $bus;
        $this->factory = $factory;
    }

    public function hasCommand($name)
    {
        return true;
    }

    public function getCommandConfig($name)
    {
        return $this->commandConfig;
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

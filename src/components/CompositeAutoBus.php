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
 * Composite autobus.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class CompositeAutoBus implements AutoBusInterface
{
    /**
     * @var AutoBusInterface[]
     */
    private $buses;

    private $cache;

    public function __construct(array $buses)
    {
        $this->buses = $buses;
    }

    public function getBusFor($name): ?AutoBusInterface
    {
        if (empty($cache[$name])) {
            $cache[$name] = $this->findBus($name);
        }

        return $cache[$name];
    }

    private function findBus($name): ?AutoBusInterface
    {
        foreach ($this->buses as $bus) {
            if ($bus->hasCommand($name)) {
                return $bus;
            }
        }

        return null;
    }

    public function getCommandConfig($name)
    {
        return $this->getBusFor($name)->getCommandConfig($name, $args);
    }

    public function hasCommand($name)
    {
        return $this->getBusFor() !== null;
    }

    public function runCommand($name, $args)
    {
        return $this->getBusFor($name)->runCommand($name, $args);
    }
}

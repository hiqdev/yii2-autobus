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

use yii\di\Container;

/**
 * AutoBus Factory using DI container.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class ContainerAutoBusFactory implements AutoBusFactoryInterface
{
    public array $mapping = [];

    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function get($name): AutoBusInterface
    {
        return $this->container->get($this->mapName($name));
    }

    protected function mapName(string $name): string
    {
        return empty($this->mapping[$name]) ? $name : $this->mapping[$name];
    }
}

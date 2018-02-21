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

use Exception;
use yii\base\Model;
use yii\di\Container;

class SimpleCommandFactory implements CommandFactoryInterface
{
    /**
     * @var Container
     */
    private $container;

    /**
     * SimpleCommandFactory constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param $config
     * @param array $args
     * @return object
     * @throws Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function create($config, array $args)
    {
        if (is_string($config)) {
            $className = $config;
            $config = [];
        } elseif (is_array($config['class']) && !empty($config['class'])) {
            $className = $config['class'];
            unset($config['class']);
        } else {
            throw new Exception('bad command config');
        }

        /** @var Model $command */
        $command = $this->container->get($className, $config);
        $command->load($args, '');

        return $command;
    }
}

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
use hiqdev\yii2\autobus\exceptions\WrongCommandException;
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
     * @throws Exception
     * @throws WrongCommandException when command config is not suitable
     * @return object
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
            throw new WrongCommandException('bad command config');
        }

        /** @var Model $command */
        $command = $this->container->get($className, $config);

        if ($args && $command instanceof Model) {
            $command->load($args, '');
        }

        return $command;
    }
}

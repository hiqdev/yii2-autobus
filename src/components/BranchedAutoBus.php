<?php
/**
 * Simple automated command bus
 *
 * @link      https://github.com/hiqdev/yii2-autobus
 * @package   yii2-autobus
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\autobus\components;

use yii\base\Component;
use yii\helpers\Inflector;

class BranchedAutoBus extends Component implements AutoBusInterface
{
    protected $bus;

    protected $factory;

    public $branches = [];

    public function __construct(CommandBusInterface $bus, CommandFactoryInterface $factory, array $config = [])
    {
        parent::__construct($config);
        $this->bus = $bus;
        $this->factory = $factory;
    }

    public function hasCommand($name)
    {
        list($branch, $action) = static::parseName($name);

        return !empty($this->branches[$branch][$action]);
    }

    public function runCommand($name, $args)
    {
        list($branch, $action) = static::parseName($name);
        if (empty($this->branches[$branch][$action])) {
            throw new WrongCommandException('no command', $name);
        }
        $config  = $this->branches[$branch][$action];
        $command = $this->factory->create($config, $args);

        return $this->handle($command);
    }

    public function handle($command)
    {
        return $this->bus->handle($command);
    }

    public static function parseName($name)
    {
        $id = Inflector::camel2id($name);

        return explode('-', $id, 2);
    }

    public static function camelSplit($input, $limit=-1)
    {
        return preg_split('/(?=[A-Z])/', $input, $limit);
    }
}

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

use hiqdev\yii2\autobus\exceptions\WrongCommandException;
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
        @list($branch, $action) = $this->parseName($name);

        return empty($this->branches[$branch][$action]);
    }

    /**
     * @param string $name the command name
     * @throws WrongCommandException
     * @return string|array
     */
    public function getCommandConfig($name)
    {
        @list($branch, $action) = $this->parseName($name);
        if (!$this->hasCommand($name)) {
            throw new WrongCommandException("no command $name");
        }

        return $this->branches[$branch][$action];
    }

    /**
     * @param string $name the command name
     * @param array $args
     * @throws WrongCommandException
     * @return mixed // todo: specify
     */
    public function runCommand($name, $args = [])
    {
        $config  = $this->getCommandConfig($name);
        $command = $this->factory->create($config, $args);

        return $this->handle($command);
    }

    public function handle($command)
    {
        return $this->bus->handle($command);
    }

    private function parseName($name)
    {
        $id = Inflector::camel2id($name);

        return explode('-', $id, 2);
    }

    public static function camelSplit($input, $limit=-1)
    {
        return preg_split('/(?=[A-Z])/', $input, $limit);
    }
}

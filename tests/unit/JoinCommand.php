<?php
/**
 * Simple automated command bus
 *
 * @link      https://github.com/hiqdev/yii2-autobus
 * @package   yii2-autobus
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2018, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\autobus\tests\unit;

class JoinCommand
{
    private $delimiter;

    private $args;

    public function __construct(string $delimiter)
    {
        $this->delimiter = $delimiter;
    }

    public function load(array $args)
    {
        $this->args = $args;
    }

    public function getDelimiter(): string
    {
        return $this->delimiter;
    }

    public function getArgs(): array
    {
        return $this->args;
    }
}

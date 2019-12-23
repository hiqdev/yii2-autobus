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

use PHPUnit\Framework\TestCase;
use Yii;
use hiqdev\yii2\autobus\components\SimpleAutoBus;
use hiqdev\yii2\autobus\components\CommandBusInterface;

/**
 * Class SimpleAutoBusTest
 */
class SimpleAutoBusTest extends TestCase

{
    private $di;

    public function setUp(): void
    {
        $this->di = Yii::$container;
        $this->bus = $this->di->get(SimpleAutoBus::class);
        parent::setUp();
    }

    public function testHasCommand()
    {
        $this->assertTrue($this->bus->hasCommand('first'));
        $this->assertFalse($this->bus->hasCommand('nonexistent'));
    }
}

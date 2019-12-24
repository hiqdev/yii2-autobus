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

use hiqdev\yii2\autobus\components\CompositeAutoBus;
use hiqdev\yii2\autobus\exceptions\WrongCommandException;
use Yii;

class CompositeAutoBusTest extends \PHPUnit\Framework\TestCase
{
    private $bus;

    public function setUp(): void
    {
        $this->bus = new CompositeAutoBus([
            Yii::$container->get('first-bus'),
            Yii::$container->get('other-bus')
        ]);
        parent::setUp();
    }

    public function testHasCommand()
    {
        $this->assertTrue($this->bus->hasCommand('first'));
        $this->assertTrue($this->bus->hasCommand('second'));
        $this->assertFalse($this->bus->hasCommand('nonexistent'));
    }

    public function testRunCommand()
    {
        $result = $this->bus->runCommand('first');
        $this->assertSame('first', $result);
        $result = $this->bus->runCommand('second');
        $this->assertSame('second', $result);
    }

    public function testWrongCommand()
    {
        $this->expectException(WrongCommandException::class);
        $this->bus->runCommand('nonexistent');
    }
}

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

use hiqdev\yii2\autobus\components\SimpleAutoBus;
use hiqdev\yii2\autobus\exceptions\WrongCommandException;
use Yii;

/**
 * Class SimpleAutoBusTest
 */
class SimpleAutoBusTest extends \PHPUnit\Framework\TestCase
{
    private $bus;

    public function setUp(): void
    {
        $this->bus = Yii::$container->get(SimpleAutoBus::class);
        parent::setUp();
    }

    public function testHasCommand()
    {
        $this->assertTrue($this->bus->hasCommand('first'));
        $this->assertFalse($this->bus->hasCommand('nonexistent'));
    }

    public function testGetCommandConfig()
    {
        $config = $this->bus->getCommandConfig('first');
        $this->assertIsArray($config);
    }

    public function testRunCommand()
    {
        $result = $this->bus->runCommand('first');
        $this->assertSame('first', $result);
        $result = $this->bus->runCommand('joinWithSpace', ['hello', 'world']);
        $this->assertSame('hello world', $result);
        $result = $this->bus->runCommand('joinWithComma', ['a', 'b', 'c']);
        $this->assertSame('a,b,c', $result);
    }

    public function testWrongCommand()
    {
        $this->expectException(WrongCommandException::class);
        $this->bus->runCommand('nonexistent');
    }
}

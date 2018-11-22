# Yii2 AutoBus

**Simple automated command bus**

[![Latest Stable Version](https://poser.pugx.org/hiqdev/yii2-autobus/v/stable)](https://packagist.org/packages/hiqdev/yii2-autobus)
[![Total Downloads](https://poser.pugx.org/hiqdev/yii2-autobus/downloads)](https://packagist.org/packages/hiqdev/yii2-autobus)
[![Build Status](https://img.shields.io/travis/hiqdev/yii2-autobus.svg)](https://travis-ci.org/hiqdev/yii2-autobus)
[![Scrutinizer Code Coverage](https://img.shields.io/scrutinizer/coverage/g/hiqdev/yii2-autobus.svg)](https://scrutinizer-ci.com/g/hiqdev/yii2-autobus/)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/hiqdev/yii2-autobus.svg)](https://scrutinizer-ci.com/g/hiqdev/yii2-autobus/)
[![Dependency Status](https://www.versioneye.com/php/hiqdev:yii2-autobus/dev-master/badge.svg)](https://www.versioneye.com/php/hiqdev:yii2-autobus/dev-master)

Simple automated bus over [Tactician] command bus.

Provides simple interface:

- `addCommands($branch, $commands)`
- `hasCommand($branch, $name)`
- `runCommand($branch, $name, $args)`

[Tactician]:    https://github.com/thephpleague/tactician

## Installation

The preferred way to install this yii2-extension is through [composer](http://getcomposer.org/download/).

Either run

```sh
php composer.phar require "hiqdev/yii2-autobus"
```

or add

```json
"hiqdev/yii2-autobus": "*"
```

to the require section of your composer.json.

## Configuration

This extension is supposed to be used with [composer-config-plugin].

Else look [config/common.php] for configuration example.

Available configuration parameters:

- `commandBus.class`

For more details please see [config/params.php].

[composer-config-plugin]:   https://github.com/hiqdev/composer-config-plugin
[config/common.php]:        config/common.php
[config/params.php]:        config/params.php

## License

This project is released under the terms of the BSD-3-Clause [license](LICENSE).
Read more [here](http://choosealicense.com/licenses/bsd-3-clause).

Copyright © 2017-2018, HiQDev (http://hiqdev.com/)

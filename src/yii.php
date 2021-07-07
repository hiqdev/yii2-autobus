<?php

namespace hiqdev\yii2\autobus;

class yii {
    public static function referenceTo($id)
    {
        return class_exists(\Yiisoft\Factory\Definition\Reference::class)
            ? \Yiisoft\Factory\Definition\Reference::to($id)
            : \yii\di\Instance::of($id);
    }
}

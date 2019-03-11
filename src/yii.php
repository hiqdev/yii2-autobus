<?php

namespace hiqdev\yii2\autobus;

class yii {
    public static function referenceTo($id)
    {
        return class_exists('Yii') ? \yii\di\Instance::of($id) : \yii\di\Reference::to($id);
    }
}

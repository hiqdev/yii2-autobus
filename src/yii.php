<?php

namespace hiqdev\yii2\autobus;

class yii {
    public static function referenceTo($id)
    {
        return class_exists('yii\\di\\Reference') ? \yii\di\Reference::to($id) : \yii\di\Instance::of($id);
    }
}

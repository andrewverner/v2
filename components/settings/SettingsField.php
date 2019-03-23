<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 23.03.2019
 * Time: 17:55
 */

namespace app\components\settings;

class SettingsField
{
    const TYPE_DROP_DOWN = 1;
    const TYPE_MULTIPLE_DROP_DOWN = 2;
    const TYPE_TEXT = 3;
    const TYPE_PASSWORD = 4;
    const TYPE_RADIO = 5;
    const TYPE_CHECKBOX = 6;

    public $name;

    public $type;

    public function __construct($config)
    {
        foreach ($config as $key => $value) {
            $this->{$key} = $value;
        }
    }
}

<?php

namespace app\components\settings;

/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.04.19
 * Time: 8:48
 *
 * Class PanelSettings
 *
 * @method CommonSettings common()
 */

class Settings
{
    private static $instance;

    private $settings = [];

    private function __construct() {}
    private function __wakeup() {}
    private function __clone() {}

    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __call($name, $arguments)
    {
        if (!isset($this->settings[$name])) {
            $className = __NAMESPACE__ . '\\' . ucfirst($name) . 'Settings';
            $this->settings[$name] = new $className;
        }

        return $this->settings[$name];
    }
}

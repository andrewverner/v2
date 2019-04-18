<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.04.19
 * Time: 8:51
 */

namespace app\components\settings;

use yii\base\Model;

abstract class PanelSettings extends Model
{
    public function __construct()
    {
        $reflection = new \ReflectionClass(get_called_class());
        $key = lcfirst(preg_replace('/Settings$/', '', $reflection->getShortName()));

        $settingsModel = \app\models\Settings::findOne(['key' => $key]);
        if (!$settingsModel || !$settingsModel->data) {
            return;
        }

        foreach (unserialize($settingsModel->data) as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return string
     */
    abstract function getGroupTitle(): string;

    abstract function getFields(): array;
}

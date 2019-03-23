<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 23.03.2019
 * Time: 17:51
 */

namespace app\components\settings;

class Application implements IAppSettings
{
    /**
     * @var string
     */
    public $appName = '';

    /**
     * @var string
     */
    public $adminEmail = '';

    public function getFields()
    {
        return [
            new SettingsField([
                'type' => SettingsField::TYPE_TEXT,
                'name' => 'appName',
            ]),
            new SettingsField([
                'type' => SettingsField::TYPE_TEXT,
                'name' => 'adminEmail',
            ]),
        ];
    }
}

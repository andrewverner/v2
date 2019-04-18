<?php

namespace app\components\settings;

use app\components\settings\fields\SettingsField;
use app\components\settings\fields\TextField;

/**
 * Class CommonSettings
 */
class CommonSettings extends PanelSettings
{
    const CART_TYPE_SESSION  = 1;
    const CART_TYPE_DATABASE = 2;

    /**
     * @var string
     */
    public $adminEmail = 'admin@mydomain.com';

    /**
     * @var int
     */
    public $cartType = self::CART_TYPE_SESSION;

    /**
     * @var int
     */
    public $allowProductReview = 1;

    /**
     * {@inheritdoc}
     */
    function getGroupTitle(): string
    {
        return \Yii::t('app', 'Common settings');
    }

    /**
     * {@inheritdoc}
     */
    function getFields(): array
    {
        return [
            'adminEmail' => (new SettingsField()),
        ];
    }
}

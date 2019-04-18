<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.04.19
 * Time: 10:47
 */

namespace app\components\settings;

use app\components\settings\fields\TextField;

class PromoSettings extends PanelSettings
{
    public $active;

    /**
     * {@inheritdoc}
     */
    function getGroupTitle(): string
    {
        return \Yii::t('app', 'Promo settings');
    }

    /**
     * {@inheritdoc}
     */
    function getFields(): array
    {
        return [
            'active' => [
                'class' => TextField::class,
            ],
        ];
    }
}

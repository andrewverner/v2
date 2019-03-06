<?php

use yii\db\Migration;

/**
 * Handles adding weight to table `{{%menu}}`.
 */
class m190306_063435_add_weight_column_to_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\Menu::tableName(), 'weight', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\Menu::tableName(), 'weight');
    }
}

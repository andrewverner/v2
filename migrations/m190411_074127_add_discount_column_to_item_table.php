<?php

use yii\db\Migration;

/**
 * Handles adding discount to table `{{%item}}`.
 */
class m190411_074127_add_discount_column_to_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\Item::tableName(), 'discount', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\Item::tableName(), 'discount');
    }
}

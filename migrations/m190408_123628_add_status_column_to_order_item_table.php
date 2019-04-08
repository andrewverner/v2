<?php

use yii\db\Migration;

/**
 * Handles adding status to table `{{%order_item}}`.
 */
class m190408_123628_add_status_column_to_order_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\OrderItem::tableName(), 'status_id', $this->integer()->notNull()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\OrderItem::tableName(), 'status_id');
    }
}

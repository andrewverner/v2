<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_item_status}}`.
 */
class m190408_123842_create_order_item_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_item_status}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'type' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created' => $this->dateTime()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->defaultExpression('NOW()'),
        ], 'charset=utf8');

        $this->insert(\app\models\OrderItemStatus::tableName(), ['title' => 'New']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_item_status}}');
    }
}

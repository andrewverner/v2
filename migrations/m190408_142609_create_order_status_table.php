<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_status}}`.
 */
class m190408_142609_create_order_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_status}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(45)->notNull(),
            'description' => $this->string(255),
            'created' => $this->dateTime()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->defaultExpression('NOW()'),
        ]);

        $this->insert(\app\models\OrderStatus::tableName(), [
            'title' => 'New',
            'description' => 'Order has been created',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_status}}');
    }
}

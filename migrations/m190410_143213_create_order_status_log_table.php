<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_status_log}}`.
 */
class m190410_143213_create_order_status_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_status_log}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'datetime' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_status_log}}');
    }
}

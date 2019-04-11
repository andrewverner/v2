<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_status_flow}}`.
 */
class m190409_060846_create_order_status_flow_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_status_flow}}', [
            'id' => $this->primaryKey(),
            'from_id' => $this->integer()->notNull(),
            'to_id' => $this->integer()->notNull(),
            'direction' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created' => $this->dateTime()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_status_flow}}');
    }
}

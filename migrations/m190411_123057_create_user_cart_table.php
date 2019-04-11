<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_cart}}`.
 */
class m190411_123057_create_user_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_cart}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'size_id' => $this->integer(),
            'quantity' => $this->integer()->notNull()->defaultValue(1),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_cart}}');
    }
}

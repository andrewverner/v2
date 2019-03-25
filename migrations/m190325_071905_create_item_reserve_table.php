<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_reserve}}`.
 */
class m190325_071905_create_item_reserve_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_reserve}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'store_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull()->defaultValue(0),
            'created' => $this->dateTime()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_reserve}}');
    }
}

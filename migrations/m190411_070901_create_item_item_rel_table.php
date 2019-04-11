<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_item_rel}}`.
 */
class m190411_070901_create_item_item_rel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_item_rel}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'related_item_id' => $this->integer()->notNull(),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_item_rel}}');
    }
}

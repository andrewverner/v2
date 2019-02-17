<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_size}}`.
 */
class m190217_100138_create_item_size_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_size}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'size_id' => $this->integer()->notNull()->defaultValue(1),
            'published' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_size}}');
    }
}

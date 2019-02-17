<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_category}}`.
 */
class m190217_095808_create_item_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_category}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_category}}');
    }
}

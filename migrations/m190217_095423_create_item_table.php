<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item}}`.
 */
class m190217_095423_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'price' => $this->integer()->notNull()->defaultValue(0),
            'published' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
    }
}

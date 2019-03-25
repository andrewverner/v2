<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store}}`.
 */
class m190325_071845_create_store_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'created' => $this->dateTime()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store}}');
    }
}

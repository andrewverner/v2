<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%block}}`.
 */
class m190222_122121_create_block_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%block}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(45)->notNull(),
            'text' => $this->text(),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%block}}');
    }
}

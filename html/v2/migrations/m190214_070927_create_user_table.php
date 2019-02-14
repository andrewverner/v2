<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m190214_070927_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(45)->notNull(),
            'password' => $this->string()->notNull(),
            'email' => $this->string(45),
            'active' => $this->tinyInteger(1)->defaultValue(0),
            'blocked' => $this->tinyInteger()->notNull()->defaultValue(0),
            'created' => $this->dateTime()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}

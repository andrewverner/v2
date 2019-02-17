<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hash}}`.
 */
class m190214_090808_create_hash_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hash}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'hash' => $this->string()->notNull(),
            'type' => $this->tinyInteger()->notNull(),
            'expired_at' => $this->dateTime()->notNull(),
            'used' => $this->tinyInteger()->notNull()->defaultValue(0),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hash}}');
    }
}

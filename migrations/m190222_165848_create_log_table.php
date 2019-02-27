<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m190222_165848_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'entity' => $this->string(45)->notNull(),
            'event_type' => $this->string(45),
            'user_id' => $this->integer()->notNull(),
            'old_attributes' => $this->string(),
            'new_attributes' => $this->string(),
            'datetime' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%log}}');
    }
}

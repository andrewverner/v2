<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notification}}`.
 */
class m190324_101653_create_notification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notification}}', [
            'id' => $this->primaryKey(),
            'type' => $this->tinyInteger()->notNull()->defaultValue(1),
            'text' => $this->text()->notNull(),
            'params' => $this->string(2048),
            'viewed' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'datetime' => $this->dateTime()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notification}}');
    }
}

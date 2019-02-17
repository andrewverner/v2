<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m190217_100512_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'path' => $this->string(45)->notNull(),
            'name' => $this->string(45)->notNull(),
            'size' => $this->integer()->notNull(),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}

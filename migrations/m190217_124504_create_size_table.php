<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%size}}`.
 */
class m190217_124504_create_size_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%size}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(10),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->insert('{{%size}}', ['value' => 'UN']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%size}}');
    }
}

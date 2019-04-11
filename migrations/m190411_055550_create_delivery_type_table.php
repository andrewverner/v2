<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%delivery_type}}`.
 */
class m190411_055550_create_delivery_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%delivery_type}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(45)->notNull(),
            'description' => $this->string(1024),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'address_needed' => $this->tinyInteger()->notNull()->defaultValue(1),
            'cost' => $this->integer()->notNull()->defaultValue(0),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%delivery_type}}');
    }
}

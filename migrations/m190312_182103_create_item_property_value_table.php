<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_property_value}}`.
 */
class m190312_182103_create_item_property_value_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_property_value}}', [
            'id' => $this->primaryKey(),
            'property_id' => $this->integer()->notNull(),
            'value' => $this->string()->notNull(),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_property_value}}');
    }
}

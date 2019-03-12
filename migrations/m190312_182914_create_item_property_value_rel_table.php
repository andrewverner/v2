<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_property_value_rel}}`.
 */
class m190312_182914_create_item_property_value_rel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_property_value_rel}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'property_value_id' => $this->integer()->notNull(),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_property_value_rel}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_property}}`.
 */
class m190312_182054_create_item_property_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_property}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'multiple' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'filterable' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_property}}');
    }
}

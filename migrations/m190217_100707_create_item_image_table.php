<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_image}}`.
 */
class m190217_100707_create_item_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_image}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'image_id' => $this->integer()->notNull(),
            'is_main' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_image}}');
    }
}

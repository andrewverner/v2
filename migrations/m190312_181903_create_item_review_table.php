<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_review}}`.
 */
class m190312_181903_create_item_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_review}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            'reviewer' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
            'rating' => $this->integer(1)->notNull()->defaultValue(5),
            'allowed' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_review}}');
    }
}

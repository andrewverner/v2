<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%promo}}`.
 */
class m190411_123717_create_promo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%promo}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(45)->notNull(),
            'description' => $this->string(1024),
            'code' => $this->string(45)->notNull(),
            'discount' => $this->integer()->notNull()->defaultValue(0),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'multiple' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'expired_at' => $this->dateTime(),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%promo}}');
    }
}

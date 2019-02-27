<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu}}`.
 */
class m190223_081130_create_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'parent' => $this->integer()->notNull()->defaultValue(0),
            'title' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%menu}}');
    }
}

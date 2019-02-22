<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%url_manager}}`.
 */
class m190222_122153_create_url_manager_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%url_manager}}', [
            'id' => $this->primaryKey(),
            'pattern' => $this->string(255)->notNull(),
            'route' => $this->string(255)->notNull(),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%url_manager}}');
    }
}

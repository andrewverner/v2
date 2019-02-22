<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jumbotron_slide}}`.
 */
class m190222_122107_create_jumbotron_slide_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%jumbotron_slide}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer()->notNull(),
            'url' => $this->string(255),
            'title' => $this->string(255),
            'text' => $this->text(),
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
        $this->dropTable('{{%jumbotron_slide}}');
    }
}

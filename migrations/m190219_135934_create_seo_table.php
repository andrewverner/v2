<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seo}}`.
 */
class m190219_135934_create_seo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%seo}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'title' => $this->string(255),
            'keywords' => $this->string(1023),
            'description' => $this->string(1023),
            'active' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%seo}}');
    }
}

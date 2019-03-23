<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%application_settings}}`.
 */
class m190323_144722_create_application_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%application_settings}}', [
            'id' => $this->primaryKey(),
            'component' => $this->string(255)->notNull(),
            'settings' => $this->string(2048),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%application_settings}}');
    }
}

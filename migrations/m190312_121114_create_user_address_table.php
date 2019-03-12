<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_address}}`.
 */
class m190312_121114_create_user_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_address}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'country' => $this->string(45)->notNull(),
            'region' => $this->string(45),
            'city' => $this->string(45)->notNull(),
            'street' => $this->string(45)->notNull(),
            'house' => $this->string(10)->notNull(),
            'flat' => $this->string(45),
            'zip_code' => $this->string(10)->notNull(),
            'geo_lat' => $this->float(8),
            'geo_lng' => $this->float(8),
            'kladr_id' => $this->string(255),
            'fias_id' => $this->string(255),
            'unrestricted_value' => $this->string(255),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client_address}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_delivery_info}}`.
 */
class m190312_114714_create_order_delivery_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_delivery_info}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
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
        $this->dropTable('{{%order_delivery_info}}');
    }
}

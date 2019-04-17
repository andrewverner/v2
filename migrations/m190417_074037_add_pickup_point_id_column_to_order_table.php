<?php

use yii\db\Migration;

/**
 * Handles adding pickup_point_id to table `{{%order}}`.
 */
class m190417_074037_add_pickup_point_id_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\Order::tableName(), 'pickup_point_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\Order::tableName(), 'pickup_point_id');
    }
}

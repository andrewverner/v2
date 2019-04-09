<?php

use yii\db\Migration;

/**
 * Handles adding color to table `{{%order_status}}`.
 */
class m190409_092413_add_color_column_to_order_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\OrderStatus::tableName(), 'color', $this->string(45));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\OrderStatus::tableName(), 'color');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles adding active to table `{{%order_status_flow}}`.
 */
class m190409_123737_add_active_column_to_order_status_flow_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\OrderStatusFlow::tableName(), 'active', $this->tinyInteger(1)->notNull()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\OrderStatusFlow::tableName(), 'active');
    }
}

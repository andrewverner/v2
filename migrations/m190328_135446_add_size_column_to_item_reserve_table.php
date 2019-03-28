<?php

use yii\db\Migration;

/**
 * Handles adding size to table `{{%item_reserve}}`.
 */
class m190328_135446_add_size_column_to_item_reserve_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\ItemReserve::tableName(), 'size_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\ItemReserve::tableName(), 'size_id');
    }
}

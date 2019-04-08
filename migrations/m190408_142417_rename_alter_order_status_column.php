<?php

use yii\db\Migration;

/**
 * Class m190408_142417_rename_alter_order_status_column
 */
class m190408_142417_rename_alter_order_status_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn(\app\models\Order::tableName(), 'status', 'status_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn(\app\models\Order::tableName(), 'status_id', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190408_142417_rename_alter_order_status_column cannot be reverted.\n";

        return false;
    }
    */
}

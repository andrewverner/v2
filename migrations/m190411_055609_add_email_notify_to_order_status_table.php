<?php

use yii\db\Migration;

/**
 * Class m190411_055609_add_email_notify_to_order_status_table
 */
class m190411_055609_add_email_notify_to_order_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\OrderStatus::tableName(), 'email_notify', $this->tinyInteger(1)->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\OrderStatus::tableName(), 'email_notify');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190411_055609_add_email_notify_to_order_status_table cannot be reverted.\n";

        return false;
    }
    */
}

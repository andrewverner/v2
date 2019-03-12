<?php

use yii\db\Migration;

/**
 * Class m190312_124018_alter_user_table
 */
class m190312_124018_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\User::tableName(), 'first_name', $this->string(45));
        $this->addColumn(\app\models\User::tableName(), 'last_name', $this->string(45));
        $this->addColumn(\app\models\User::tableName(), 'middle_name', $this->string(45));
        $this->addColumn(\app\models\User::tableName(), 'phone', $this->string(45));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\User::tableName(), 'first_name');
        $this->dropColumn(\app\models\User::tableName(), 'last_name');
        $this->dropColumn(\app\models\User::tableName(), 'middle_name');
        $this->dropColumn(\app\models\User::tableName(), 'phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190312_124018_alter_user_table cannot be reverted.\n";

        return false;
    }
    */
}

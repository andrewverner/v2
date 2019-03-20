<?php

use yii\db\Migration;

/**
 * Class m190320_082708_alter_seo_table
 */
class m190320_082708_alter_seo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn(\app\models\Seo::tableName(), 'url');
        $this->addColumn(\app\models\Seo::tableName(), 'entity_type', $this->string(45)->notNull());
        $this->addColumn(\app\models\Seo::tableName(), 'entity_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn(\app\models\Seo::tableName(), 'url', $this->string()->notNull());
        $this->dropColumn(\app\models\Seo::tableName(), 'entity_type');
        $this->dropColumn(\app\models\Seo::tableName(), 'entity_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190320_082708_alter_seo_table cannot be reverted.\n";

        return false;
    }
    */
}

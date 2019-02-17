<?php

use yii\db\Migration;

/**
 * Class m190217_093426_create_root_category
 */
class m190217_093426_create_root_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $category = new \app\models\Category(['name' => 'Корень']);
        $category->makeRoot();
        $category->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable(\app\models\Category::tableName());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190217_093426_create_root_category cannot be reverted.\n";

        return false;
    }
    */
}

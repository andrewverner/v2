<?php

use yii\db\Migration;

/**
 * Handles adding published to table `{{%category}}`.
 */
class m190217_130910_add_published_column_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\Category::tableName(), 'published', $this->tinyInteger(1)->notNull()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\Category::tableName(), 'published');
    }
}

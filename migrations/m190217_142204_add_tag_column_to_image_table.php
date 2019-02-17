<?php

use yii\db\Migration;

/**
 * Handles adding tag to table `{{%image}}`.
 */
class m190217_142204_add_tag_column_to_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\Image::tableName(), 'tags', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\Image::tableName(), 'tags');
    }
}

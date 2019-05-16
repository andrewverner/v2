<?php

use yii\db\Migration;

/**
 * Handles adding type_and_position to table `{{%block}}`.
 */
class m190511_175422_add_type_and_position_column_to_block_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\Block::tableName(), 'type', $this->tinyInteger(2)->after('text')->notNull()->defaultValue(1));
        $this->addColumn(\app\models\Block::tableName(), 'position', $this->tinyInteger(2)->after('text')->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\Block::tableName(), 'type');
        $this->dropColumn(\app\models\Block::tableName(), 'position');
    }
}

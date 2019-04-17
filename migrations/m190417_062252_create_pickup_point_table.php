<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pickup_point}}`.
 */
class m190417_062252_create_pickup_point_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pickup_point}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string(255)->notNull(),
            'geo_lat' => $this->float(8),
            'geo_lng' => $this->float(8),
            'work_time' => $this->string(255),
            'phone' => $this->string(255),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pickup_point}}');
    }
}

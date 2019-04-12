<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%promo_exception}}`.
 */
class m190412_062354_create_promo_exception_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%promo_exception}}', [
            'id' => $this->primaryKey(),
            'promo_id' => $this->integer()->notNull(),
            'entity_type' => $this->integer()->notNull()->defaultValue(1),
            'entity_id' => $this->integer()->notNull(),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'updated' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%promo_exception}}');
    }
}

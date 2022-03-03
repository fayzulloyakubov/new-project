<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%auth_item}}`.
 */
class m220303_143827_add_column_to_category_column_to_auth_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%auth_item}}', 'category', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%auth_item}}', 'category');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%change_limit}}`.
 */
class m220303_052258_create_change_limit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%change_limit}}', [
            'id' => $this->primaryKey(),
            'old_limit_date' => $this->datetime(),
            'new_limit_date' => $this->datetime(),
            'change_limit_reason' => $this->text(),
            'add_info' => $this->text(),
            'status' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%change_limit}}');
    }
}

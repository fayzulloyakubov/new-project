<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%change_executor}}`.
 */
class m220303_051502_create_change_executor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%change_executor}}', [
            'id' => $this->primaryKey(),
            'old_executor_date' => $this->datetime(),
            'new_executor_date' => $this->date(),
            'change_executor_reason' => $this->text(),
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
        $this->dropTable('{{%change_executor}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%check_result}}`.
 */
class m220303_051819_create_check_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%check_result}}', [
            'id' => $this->primaryKey(),
            'check_result_name' => $this->string(255),
            'check_result_date' => $this->datetime(),
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
        $this->dropTable('{{%check_result}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%change_term}}`.
 */
class m220303_051324_create_change_term_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%change_term}}', [
            'id' => $this->primaryKey(),
            'old_term_date' => $this->datetime(),
            'new_term_date' => $this->date(),
            'change_term_reason' => $this->text(),
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
        $this->dropTable('{{%change_term}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%change_classification}}`.
 */
class m220303_052055_create_change_classification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%change_classification}}', [
            'id' => $this->primaryKey(),
            'old_classification_date' => $this->datetime(),
            'new_classification_date' => $this->datetime(),
            'change_classification_reason' => $this->text(),
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
        $this->dropTable('{{%change_classification}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%references}}`.
 */
class m220303_050557_create_references_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%references}}', [
            'id' => $this->primaryKey(),
            'reference_name' => $this->string(255),
            'reference_date' => $this->datetime(),
            'reference_content' => $this->text(),
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
        $this->dropTable('{{%references}}');
    }
}

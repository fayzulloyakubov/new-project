<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%queries}}`.
 */
class m220303_051006_create_queries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%queries}}', [
            'id' => $this->primaryKey(),
            'queries_name' => $this->string(255),
            'queries_date' => $this->datetime(),
            'queries_content' => $this->text(),
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
        $this->dropTable('{{%queries}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%issues}}`.
 */
class m220303_050841_create_issues_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%issues}}', [
            'id' => $this->primaryKey(),
            'issues_name' => $this->string(255),
            'issues_date' => $this->datetime(),
            'issues_content' => $this->text(),
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
        $this->dropTable('{{%issues}}');
    }
}

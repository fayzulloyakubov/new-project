<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%some_drop}}`.
 */
class m220304_115925_create_some_drop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-user_refresh_tokens-user_id}}',
            '{{%user_refresh_tokens}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_refresh_tokens-user_id}}',
            '{{%user_refresh_tokens}}'
        );

        $this->dropTable('{{%user_refresh_tokens}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%user_refresh_tokens}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'refresh_token' => $this->string(255),
            'expire_to' => $this->integer(),
            'expire_refresh_token' => $this->integer(),
            'status' => $this->tinyInteger(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_refresh_tokens-user_id}}',
            '{{%user_refresh_tokens}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-user_refresh_tokens-user_id}}',
            '{{%user_refresh_tokens}}',
            'user_id',
            '{{%users}}',
            'id',
            'RESTRICT'
        );
    }
}

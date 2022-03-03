<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%menu}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%menu}}`
 */
class m220303_100121_add_parent_id_column_to_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%menu}}', 'parent_id', $this->integer());

        // creates index for column `parent_id`
        $this->createIndex(
            '{{%idx-menu-parent_id}}',
            '{{%menu}}',
            'parent_id'
        );

        // add foreign key for table `{{%menu}}`
        $this->addForeignKey(
            '{{%fk-menu-parent_id}}',
            '{{%menu}}',
            'parent_id',
            '{{%menu}}',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%menu}}`
        $this->dropForeignKey(
            '{{%fk-menu-parent_id}}',
            '{{%menu}}'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            '{{%idx-menu-parent_id}}',
            '{{%menu}}'
        );

        $this->dropColumn('{{%menu}}', 'parent_id');
    }
}

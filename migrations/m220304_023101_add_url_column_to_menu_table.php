<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%menu}}`.
 */
class m220304_023101_add_url_column_to_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%menu}}', 'icon_name', $this->string(100));
        $this->addColumn('{{%menu}}', 'url', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%menu}}', 'icon_name');
        $this->dropColumn('{{%menu}}', 'url');
    }
}

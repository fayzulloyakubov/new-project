<?php

use yii\db\Migration;

/**
 * Class m220304_023700_upsert_data_column_to_menu_table
 */
class m220304_040000_upsert_data_column_to_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->upsert('{{%users}}', ['id' => 1,'name' => 'admin',  'username' => 'admin', 'password' => md5('1'), 'status' => 1], true);
        $this->upsert('{{%users}}', ['id' => 2,'name' => 'Monitoring',  'username' => 'monitoring', 'password' => md5('1'), 'status' => 1], true);
        $this->upsert('{{%users}}', ['id' => 3,'name' => 'Foydalanuvchi', 'username' => 'user', 'password' => md5('1'), 'status' => 1], true);

        $this->upsert('{{%menu}}', ['id' => 2,'menu_name' => 'Administrator',  'parent_id' => null, 'icon_name' => 'fa fa-users-cog', 'url' => '#', 'status' => 1], true);
        $this->upsert('{{%menu}}', ['id' => 3,'menu_name' => 'Foydalanuvchilar',  'parent_id' => 2, 'icon_name' => 'fa fa-user', 'url' => '/admin/users/index', 'status' => 1], true);
        $this->upsert('{{%menu}}', ['id' => 4,'menu_name' => 'Ruxsatlar',  'parent_id' => 2, 'icon_name' => 'fa fa-shield-alt', 'url' => '/admin/auth-item/permissions', 'status' => 1], true);

        $this->upsert('{{%menu}}', ['id' => 5,'menu_name' => 'Bosh sahifa',  'parent_id' => null, 'url' => '#', 'icon_name' => 'fa fa-home', 'status' => 1], true);
        $this->upsert('{{%menu}}', ['id' => 6,'menu_name' => 'Murojaatlar',  'parent_id' => null, 'url' => '#', 'icon_name' => 'fa fa-file', 'status' => 1], true);
        $this->upsert('{{%menu}}', ['id' => 7,'menu_name' => 'Masalalar', 'parent_id' => null, 'url' => '#', 'icon_name' => 'fa fa-comments', 'status' => 1], true);
        $this->upsert('{{%menu}}', ['id' => 8,'menu_name' => 'So\'rovlar', 'parent_id' => null, 'url' => '#', 'icon_name' => 'fa fa-bell', 'status' => 1], true);
        $this->upsert('{{%menu}}', ['id' => 9,'menu_name' => 'Muddatni o\'zgartirish', 'parent_id' => 7, 'url' => '/information/change-term/index', 'icon_name' => 'fa fa-file-alt', 'status' => 1], true);
        $this->upsert('{{%menu}}', ['id' => 10,'menu_name' => 'Ijrochini o\'zgartirish', 'parent_id' => 7, 'url' => '/information/change-executor/index', 'icon_name' => 'fa fa-file-alt', 'status' => 1], true);
        $this->upsert('{{%menu}}', ['id' => 11,'menu_name' => 'Natijani tekshirish', 'parent_id' => 7, 'url' => '/information/check-result/index', 'icon_name' => 'fa fa-file-alt', 'status' => 1], true);
        $this->upsert('{{%menu}}', ['id' => 12,'menu_name' => 'Tasnifni o\'zgartirish', 'parent_id' => 8, 'url' => '/information/change-classification/index', 'icon_name' => 'fa fa-file-alt', 'status' => 1], true);
        $this->upsert('{{%menu}}', ['id' => 13,'menu_name' => 'Cheklovni o\'zgartirish', 'parent_id' => 8, 'url' => '/information/change-limit/index', 'icon_name' => 'fa fa-file-alt', 'status' => 1], true);
        $this->upsert('{{%menu}}', ['id' => 14,'menu_name' => 'Bog\'lanish', 'parent_id' => 2, 'url' => '/settings/menu/index', 'icon_name' => 'fa fa-link', 'status' => 1], true);

        $this->upsert('{{%auth_item}}', ['name' => 'Administrator', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Foydalanuvchilar', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Ruxsatlar', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Bosh sahifa', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Murojaatlar', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Masalalar', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'So\'rovlar', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Muddatni o\'zgartirish', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Ijrochini o\'zgartirish', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Natijani tekshirish', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Tasnifni o\'zgartirish', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Cheklovni o\'zgartirish', 'type' => 2], true);
        $this->upsert('{{%auth_item}}', ['name' => 'Bog\'lanish', 'type' => 2], true);

        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Ruxsatlar', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Ruxsatlar', 'user_id' => 2], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Administrator', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Administrator', 'user_id' => 2], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Foydalanuvchilar', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Foydalanuvchilar', 'user_id' => 2], true);

        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Bosh sahifa', 'user_id' => 3], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Murojaatlar', 'user_id' => 2], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Masalalar', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'So\'rovlar', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Muddatni o\'zgartirish', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Ijrochini o\'zgartirish', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Natijani tekshirish', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Tasnifni o\'zgartirish', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Cheklovni o\'zgartirish', 'user_id' => 1], true);
        $this->upsert('{{%auth_assignment}}', ['item_name' => 'Bog\'lanish', 'user_id' => 1], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220304_023700_upsert_data_column_to_menu_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220304_023700_upsert_data_column_to_menu_table cannot be reverted.\n";

        return false;
    }
    */
}

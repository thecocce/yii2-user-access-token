<?php

use yii\db\Migration;

class m160818_064444_access_token_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('user_access_token', [
        'id' => $this->primaryKey(),
        'type' => "ENUM('default', 'facebook','google','live') NOT NULL DEFAULT 'default'", //todo: remove hardcoding to config
        'user_id' => $this->integer(),
        'token' => $this->string(64)->notNull(),
        ], $tableOptions);
        $this->addForeignKey('fk_user_access_token', 'user_access_token', 'user_id', '{{%user}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('user_access_token');
        return true;
    }

}

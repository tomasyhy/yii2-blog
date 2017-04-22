<?php

use yii\db\Migration;
use yii\db\Schema;

class m170107_132012_create_table_comment extends Migration
{
    public function up()
    {
        $this->createTable('{{%comment}}', [
            'id' => Schema::TYPE_INTEGER . ' UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'post_id' => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'author' => Schema::TYPE_STRING . '(45) NOT NULL',
            'email' => Schema::TYPE_STRING . '(45) NOT NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'enabled' => Schema::TYPE_BOOLEAN . ' DEFAULT 0',
        ]);

        $this->addForeignKey('fk_comment_post_post_id', '{{%comment}}', 'post_id', '{{%post}}', 'id', 'CASCADE');


    }

    public function down()
    {
        $this->dropTable('{{%comment}}');
    }
}

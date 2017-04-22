<?php

use yii\db\Migration;
use yii\db\Schema;

class m170107_124753_create_table_post extends Migration
{
    public function up()
    {
        $this->createTable('{{%post}}', [
            'id' => Schema::TYPE_INTEGER . ' UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_BOOLEAN . ' DEFAULT 0',

        ]);

    }
    
    public function down()
    {
        $this->dropTable('{{%post}}');
    }
}

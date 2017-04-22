<?php

use yii\db\Migration;
use yii\db\Schema;

class m170107_131944_create_table_tag extends Migration
{
    public function up()
    {
        $this->createTable('{{%tag}}', [
            'id' => Schema::TYPE_SMALLINT . ' UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'title' => Schema::TYPE_STRING . '(45) NOT NULL',
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%tag}}');
    }
}

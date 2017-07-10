<?php

use yii\db\Migration;
use yii\db\Schema;

class m170107_132000_create_table_post_tag extends Migration
{
    public function up()
    {
        $this->createTable('{{%post_tag}}', [
            'post_id' => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'tag_id' => Schema::TYPE_SMALLINT . ' UNSIGNED NOT NULL',
        ]);

        $this->addForeignKey('fk_post_tag_post_post_id', '{{%post_tag}}', 'post_id', '{{%post}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_post_tag_tag_tag_id', '{{%post_tag}}', 'tag_id', '{{%tag}}', 'id', 'CASCADE');

        $this->addPrimaryKey('post_id-tag_id', 'post_tag', ['post_id', 'tag_id']);


    }

    public function down()
    {
        $this->dropTable('{{%post_tag}}');
    }
}

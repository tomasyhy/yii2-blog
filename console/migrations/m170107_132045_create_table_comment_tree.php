<?php

use yii\db\Migration;
use yii\db\Schema;

class m170107_132045_create_table_comment_tree extends Migration
{
    public function up()
    {
        $this->createTable('{{%comment_tree}}', [
            'ancestor' => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'descendant' => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
        ]);

        $this->addForeignKey('fk_comment_tree_comment_ancestor', '{{%comment_tree}}', 'ancestor', '{{%comment}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_comment_tree_comment_descendant', '{{%comment_tree}}', 'descendant', '{{%comment}}', 'id', 'CASCADE');

        $this->addPrimaryKey('ancestor-descendant', 'comment_tree', ['ancestor', 'descendant']);

    }

    public function down()
    {
        $this->dropTable('{{%comment_tree}}');
    }
    
}

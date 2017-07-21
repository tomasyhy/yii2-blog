<?php

use yii\db\Migration;

class m170721_085131_add_column_about_me_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'about_me', $this->text());
    }

    public function down()
    {
        $this->dropColumn('user', 'about_me');
    }
}

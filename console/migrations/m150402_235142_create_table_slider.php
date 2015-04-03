<?php

use yii\db\Schema;
use yii\db\Migration;

class m150402_235142_create_table_slider extends Migration
{
    public function up()
    {
        $this->createTable('slider',[
            'id' => 'pk',
            'picture' => Schema::TYPE_STRING . ' DEFAULT NULL',
            'title' => Schema::TYPE_STRING . ' DEFAULT NULL',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function down()
    {
        $this->dropTable('slider');
    }
}

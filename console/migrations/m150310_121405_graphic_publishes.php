<?php

use yii\db\Schema;
use yii\db\Migration;

class m150310_121405_graphic_publishes extends Migration
{
    public function up()
    {
        $this->createTable('graphic_publishes',
        [
            'id' => 'pk',
            'image' => Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "image for publish source"',
        ],
        'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->insert('graphic_publishes', ['image'=>'']);
        $this->insert('graphic_publishes', ['image'=>'facebook.png']);
        $this->insert('graphic_publishes', ['image'=>'twitter.png']);
        $this->insert('graphic_publishes', ['image'=>'google.png']);
        $this->insert('graphic_publishes', ['image'=>'youtube.png']);
    }

    public function down()
    {
        $this->dropTable('graphic_publishes');
    }
}

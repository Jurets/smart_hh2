<?php

use yii\db\Schema;
use yii\db\Migration;

class m141114_003549_language_convension_v1 extends Migration
{
    public function up()
    {
        $this->insert('language', ['name'=>'en']);
        $this->insert('language', ['name'=>'ru']);        
    }

    public function down()
    {
       $this->delete('language');
    }
}

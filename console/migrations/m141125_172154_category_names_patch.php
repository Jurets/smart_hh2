<?php

use yii\db\Schema;
use yii\db\Migration;

class m141125_172154_category_names_patch extends Migration
{
    public function up()
    {
       $this->update('category', ['name'=>'with supplies'], ['id'=>70]); 
       $this->update('category', ['name'=>'without supplies'], ['id'=>71]);
    }

    public function down()
    {
       $this->update('category', ['name'=>'photo'], ['id'=>70]); 
       $this->update('category', ['name'=>'photo'], ['id'=>71]);
    }
}

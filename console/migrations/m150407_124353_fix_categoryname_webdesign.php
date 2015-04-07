<?php

use yii\db\Schema;
use yii\db\Migration;

class m150407_124353_fix_categoryname_webdesign extends Migration
{
    public function up()
    {
        $this->update('category', ['name'=>'Webdesign & Internet'], ['name'=>'Webdisign & Internet']);
    }

    public function down()
    {
        echo "update one record. reverse action is not required\n";

        return true;
    }
}

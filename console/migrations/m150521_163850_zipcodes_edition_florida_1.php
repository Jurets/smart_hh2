<?php

use yii\db\Schema;
use yii\db\Migration;

class m150521_163850_zipcodes_edition_florida_1 extends Migration
{
    public function up()
    {
        $sql = file_get_contents(dirname(__FILE__).DIRECTORY_SEPARATOR .'m-scripts'.DIRECTORY_SEPARATOR.'Miami_edition_1.sql');
        $this->execute($sql);
    }

    public function down()
    {
        // nothing to do
        return true;
    }
    
}

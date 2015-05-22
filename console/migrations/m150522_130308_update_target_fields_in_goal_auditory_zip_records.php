<?php

use yii\db\Schema;
use yii\db\Migration;

class m150522_130308_update_target_fields_in_goal_auditory_zip_records extends Migration
{
    public function up()
    {
        $sql = file_get_contents(dirname(__FILE__).DIRECTORY_SEPARATOR .'m-scripts'.DIRECTORY_SEPARATOR.'Miami_targetstatus_edition_1.sql');
        $this->execute($sql);
    }

    public function down()
    {
       return true; // nothing to do
    }
    
}

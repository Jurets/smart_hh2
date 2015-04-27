<?php

use yii\db\Schema;
use yii\db\Migration;

class m150424_153634_add_assembled_zip_into_ticket extends Migration
{
    public function up()
    {
        $this->addColumn('ticket', 'assembled_zip', Schema::TYPE_INTEGER . ' DEFAULT NULL AFTER zip_id');
    }

    public function down()
    {
        $this->dropColumn('ticket', 'assembled_zip');
    }
    
}

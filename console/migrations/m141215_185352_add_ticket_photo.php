<?php

use yii\db\Schema;
use yii\db\Migration;

class m141215_185352_add_ticket_photo extends Migration
{
    public function up()
    {
        $this->addColumn('ticket', 'photo', Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "photomaterial to the ticket" AFTER id');
    }

    public function down()
    {
       $this->dropColumn('ticket', 'photo');
    }
}

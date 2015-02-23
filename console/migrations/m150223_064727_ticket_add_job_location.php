<?php

use yii\db\Schema;
use yii\db\Migration;

class m150223_064727_ticket_add_job_location extends Migration
{
    public function up()
    {
        $this->addColumn('ticket', 'job_location', Schema::TYPE_STRING . '(512) NULL DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('ticket', 'job_location');
    }
}

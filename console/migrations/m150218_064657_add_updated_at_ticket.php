<?php

use yii\db\Schema;
use yii\db\Migration;

class m150218_064657_add_updated_at_ticket extends Migration
{
    public function up()
    {
        $this->addColumn('ticket', 'updated_at', Schema::TYPE_TIMESTAMP);
    }

    public function down()
    {
        $this->dropColumn('ticket', 'updated_at');
    }
}

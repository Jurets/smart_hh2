<?php

use yii\db\Schema;
use yii\db\Migration;

class m141216_151045_ticket_change_datestatament_to_the_timestamp extends Migration
{
    public function up()
    {
        $this->alterColumn('ticket', 'start_day', 'TIMESTAMP');
        $this->alterColumn('ticket', 'finish_day', 'TIMESTAMP');
    }

    public function down()
    {
        $this->alterColumn('ticket', 'start_day', 'date DEFAULT NULL');
        $this->alterColumn('ticket', 'finish_day', 'date DEFAULT NULL');
    }
}

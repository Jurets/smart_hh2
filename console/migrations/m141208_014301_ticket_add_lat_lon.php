<?php

use yii\db\Schema;
use yii\db\Migration;

class m141208_014301_ticket_add_lat_lon extends Migration
{
    public function up()
    {
        $this->addColumn('ticket', 'lat', Schema::TYPE_FLOAT . ' DEFAULT NULL COMMENT "Latitude" AFTER performer_id');
        $this->addColumn('ticket', 'lon', Schema::TYPE_FLOAT . ' DEFAULT NULL COMMENT "Longitude" AFTER lat');
    }

    public function down()
    {
        $this->dropColumn('ticket', 'lat');
        $this->dropColumn('ticket', 'lon');
    }
}

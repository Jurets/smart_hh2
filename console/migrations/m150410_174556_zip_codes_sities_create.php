<?php

use yii\db\Schema;
use yii\db\Migration;

class m150410_174556_zip_codes_sities_create extends Migration
{
    public function safeUp()
    {
        $this->createTable('zips', [
            'id' => 'pk',
            'zip' => 'int(5) DEFAULT NULL',
            'state' => 'varchar(2) DEFAULT NULL',
            'city' => 'varchar(16) DEFAULT NULL',
            'lat' => Schema::TYPE_FLOAT . ' DEFAULT NULL',
            'lng' => Schema::TYPE_FLOAT . ' DEFAULT NULL'
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        
        $sql = file_get_contents(dirname(__FILE__).DIRECTORY_SEPARATOR .'m-scripts'.DIRECTORY_SEPARATOR.'cities.sql');
        $this->execute($sql);
        
        $this->addColumn('ticket', 'zip_id', Schema::TYPE_INTEGER . ' DEFAULT NULL');
        $this->addForeignKey('zip_ticket_conduct_zips', 'ticket', 'zip_id', 'zips', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
       $this->dropForeignKey('zip_ticket_conduct_zips', 'ticket');
       $this->dropColumn('ticket', 'zip_id');
       $this->dropTable('zips');
    }
}

<?php

use yii\db\Schema;
use yii\db\Migration;

/* bind category with ticket with FK category_id  */
class m141125_140007_bind_category_with_ticket extends Migration
{
    public function up()
    {
        
        $this->addForeignKey('FK_ticket_category_id', 'ticket', 'id_category', 'category', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('FK_ticket_category_id', 'ticket');
    }
}

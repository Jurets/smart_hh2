<?php

use yii\db\Schema;
use yii\db\Migration;

class m141030_133936_drop_column_performer_id_from_ticket extends Migration
{

    public function up()
    {
        
        $this->dropColumn("ticket", "performer_id");
        $this->createIndex("idx_id_user", "ticket", "user_id");
        $this->addForeignKey("fk_ticket_id_user", "ticket", "user_id", "user", "id");
        
        $this->createIndex("idx_id_category", "ticket", "id_category");
        $this->addForeignKey("fk_category_id_ticket", "category", "id", "ticket", "id_category");
    }

    public function down()
    {
        $this->addColumn("ticket", "performer_id", "INT");
        $this->dropForeignKey("fk_ticket_id_user", "ticket");
        $this->dropIndex("idx_id_user", "ticket");
        
        $this->dropForeignKey("fk_category_id_ticket", "category");
        $this->dropIndex("idx_id_category", "ticket");
                
    }

}

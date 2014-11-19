<?php

use yii\db\Schema;
use yii\db\Migration;

class m141118_140908_update_category_v1 extends Migration
{
    public function up()
    {
        $this->addColumn('category', 'parent_id', 'int(11) DEFAULT NULL');
        $this->addColumn('category', 'level', 'tinyint(4) DEFAULT NULL');
        $this->addColumn('category', 'picture', 'varchar(255) DEFAULT NULL');
        $this->addColumn('category', 'weight', 'tinyint(4) DEFAULT NULL');
        $this->addColumn('category', 'active', 'tinyint(2) DEFAULT NULL');
        $this->dropForeignKey("fk_category_id_ticket", "category");
    }

    public function down()
    {
        $this->dropColumn('category', 'parent_id');
        $this->dropColumn('category', 'level');
        $this->dropColumn('category', 'picture');
        $this->dropColumn('category', 'weight');
        $this->dropColumn('category', 'active');
        $this->addForeignKey("fk_category_id_ticket", "category", "id", "ticket", "id_category");
    }
}

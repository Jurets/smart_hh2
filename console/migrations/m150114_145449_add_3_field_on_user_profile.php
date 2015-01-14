<?php

use yii\db\Schema;
use yii\db\Migration;

class m150114_145449_add_3_field_on_user_profile extends Migration
{
    public function up()
    {
        $this->addColumn('profile', 'rating', Schema::TYPE_INTEGER . ' DEFAULT NULL COMMENT "users rating from positive reviews"');
        $this->addColumn('profile', 'done_tasks', Schema::TYPE_INTEGER. ' DEFAULT NULL COMMENT "additional counter for store how many tasks exists"');
        $this->addColumn('profile', 'created_tasks', Schema::TYPE_INTEGER. ' DEFAULT NULL COMMENT "additional counter for store how mach tasks was created"');
    }

    public function down()
    {
        $this->dropColumn('profile', 'rating');
        $this->dropColumn('profile', 'done_tasks');
        $this->dropColumn('profile', 'created_tasks');
    }
}

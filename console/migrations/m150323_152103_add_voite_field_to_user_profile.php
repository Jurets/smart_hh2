<?php

use yii\db\Schema;
use yii\db\Migration;

class m150323_152103_add_voite_field_to_user_profile extends Migration
{
    public function up()
    {
        $this->addColumn('profile', 'voice', Schema::TYPE_BIGINT . ' DEFAULT NULL COMMENT "All voices for rating" AFTER rating');
    }

    public function down()
    {
        $this->dropColumn('profile', 'voice');
    }
}

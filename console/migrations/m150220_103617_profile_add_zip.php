<?php

use yii\db\Schema;
use yii\db\Migration;

class m150220_103617_profile_add_zip extends Migration
{
    public function up()
    {
        $this->addColumn('profile', 'zip_mailing', Schema::TYPE_INTEGER . ' NULL DEFAULT NULL');
        $this->addColumn('profile', 'zip_billing', Schema::TYPE_INTEGER . ' NULL DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('profile', 'zip_mailing');
        $this->dropColumn('profile', 'zip_billing');
    }
}

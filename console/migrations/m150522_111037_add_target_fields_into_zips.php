<?php

use yii\db\Schema;
use yii\db\Migration;

class m150522_111037_add_target_fields_into_zips extends Migration
{
    public function up()
    {
        $this->addColumn('zips', 'target', Schema::TYPE_BOOLEAN . ' DEFAULT 0 COMMENT "признак записи для целевой аудитории"');
    }

    public function down()
    {
        $this->dropColumn('zips', 'target');
    }
}

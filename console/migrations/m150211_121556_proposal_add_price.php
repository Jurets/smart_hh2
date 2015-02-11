<?php

use yii\db\Schema;
use yii\db\Migration;

class m150211_121556_proposal_add_price extends Migration
{
    public function up()
    {
        $this->addColumn('proposal', 'price', Schema::TYPE_FLOAT . ' DEFAULT NULL COMMENT "preliminary price if ticket price is null" AFTER id');
    }

    public function down()
    {
        $this->dropColumn('proposal', 'price');
    }
}

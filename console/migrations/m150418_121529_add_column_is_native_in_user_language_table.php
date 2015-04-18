<?php

use yii\db\Schema;
use yii\db\Migration;

class m150418_121529_add_column_is_native_in_user_language_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user_language', 'is_native', Schema::TYPE_BOOLEAN . ' NOT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('user_language', 'is_native');
    }

}

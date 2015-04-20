<?php

use yii\db\Schema;
use yii\db\Migration;

class m150420_091544_add_new_column_to_language_table extends Migration
{

    public function safeUp()
    {
        $this->addColumn('language', 'full_name', Schema::TYPE_STRING . ' DEFAULT NULL');

        $this->update('language', ['full_name' => 'English'], ['id' => 1]);
        $this->update('language', ['full_name' => 'Русский'], ['id' => 2]);
        $this->update('language', ['full_name' => 'Español'], ['id' => 3]);
        $this->update('language', ['full_name' => 'português'], ['id' => 4]);
    }

    public function safeDown()
    {
        $this->dropColumn('language', 'full_name');
    }
}

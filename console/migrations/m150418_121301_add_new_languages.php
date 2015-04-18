<?php

use yii\db\Schema;
use yii\db\Migration;

class m150418_121301_add_new_languages extends Migration
{
    public function safeUp()
    {
        $this->insert('language', ['id' => 3, 'name' => 'spa']);
        $this->insert('language', ['id' => 4, 'name' => 'por']);
    }

    public function safeDown()
    {
        $this->delete('language', ['id' => 3]);
        $this->delete('language', ['id' => 4]);
    }
}

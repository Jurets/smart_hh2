<?php

use yii\db\Schema;
use yii\db\Migration;

class m150923_110228_neo_language_insert extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%user_language}}', ['user_id','language_id','knowledge','is_native'],
        [
             ['1', '1', '5', '1']]);
    }

    public function down()
    {
        echo "m150923_110228_neo_language_insert cannot be reverted.\n";

        return false;
    }
}

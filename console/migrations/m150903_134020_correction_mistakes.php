<?php

use yii\db\Schema;
use yii\db\Migration;

class m150903_134020_correction_mistakes extends Migration
{
    public function up()
    {
		$this->update('category', ['name' => 'dishwasher'], 'id=51');
		$this->update('category', ['name' => 'air conditioner'], 'id=54');
		$this->update('category', ['name' => 'stove/microwave'], 'id=55');
    }

    public function down()
    {
        echo "m150903_134020_correction_mistakes cannot be reverted.\n";
        return false;
    }
}

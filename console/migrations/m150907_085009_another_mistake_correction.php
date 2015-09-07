<?php

use yii\db\Schema;
use yii\db\Migration;

class m150907_085009_another_mistake_correction extends Migration
{
    public function up()
    {
		$this->update('category', ['name' => 'Electronics'], 'id=3');
    }

    public function down()
    {
        echo "m150907_085009_another_mistake_correction cannot be reverted.\n";
        return false;
    }
}

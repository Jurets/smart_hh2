<?php

use yii\db\Migration;

class m150210_102721_insert_social_networks_data extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('social_network', ['id','title','icon'], [
            [1, 'facebook', 'icon-facebook.png'],
            [2, 'linkedIn', 'icon-in.png'],
            [3, 'phone', 'icon-tel.png'],
            [4, 'cellphone', 'icon-phone.png'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('social_network', 'id in (1,2,3,4)');
    }
}

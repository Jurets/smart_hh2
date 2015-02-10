<?php

use yii\db\Schema;
use yii\db\Migration;

class m150209_142029_create_user_social_network extends Migration
{
    public function safeUp()
    {
        $this->createTable('social_network', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL COMMENT "title of social network"',
            'icon' => Schema::TYPE_STRING . ' NOT NULL COMMENT "icon filename"',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        
        $this->createTable('user_social_network', [
            'social_network_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'url' => Schema::TYPE_STRING . ' NOT NULL COMMENT "url to user page in particular social network"',
            'moderate' => Schema::TYPE_SMALLINT . ' DEFAULT 0 COMMENT "moderation signature: 0 - frontend access disabled 1 - enabled"'
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        
        $this->addPrimaryKey('pk_user_social_network', 'user_social_network', ['social_network_id', 'user_id']);
        $this->addForeignKey('fk_user_social_network_social_network', 'user_social_network', 'social_network_id', 'social_network', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_user_social_network_user', 'user_social_network', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('user_social_network');
        $this->dropTable('social_network');
    }
}

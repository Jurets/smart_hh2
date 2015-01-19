<?php

use yii\db\Schema;
use yii\db\Migration;

class m150119_033001_user_speciality extends Migration
{
    public function up()
    {
        $this->createTable('user_speciality',
                [
                    'user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "FK to user"',
                    'category_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "FK to category"',
                ]);
        $this->addPrimaryKey('pk_user_spec', 'user_speciality', ['user_id', 'category_id']);
        $this->addForeignKey('fk_to_user-spec', 'user_speciality', 'user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_to_category-spec', 'user_speciality', 'category_id', 'category', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
       $this->dropForeignKey('fk_to_user-spec', 'user_speciality');
       $this->dropForeignKey('fk_to_category-spec', 'user_speciality');
       $this->dropTable('user_speciality');
    }
}

<?php

use yii\db\Schema;
use yii\db\Migration;

class m150310_132435_footer_content extends Migration
{
    public function up()
    {
        $this->createTable('footer_content', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL COMMENT "destination where reference must be rendered"',
            'lang' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "foreign key to the language"',
            'reference' => Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "url to target page"',
            'img' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "reference image wrapper FK to graphic publishes"',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->addForeignKey('fkFooter_to_language', 'footer_content', 'lang', 'language', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fkFooter_to_graphic_publishes', 'footer_content', 'img', 'graphic_publishes', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fkFooter_to_language', 'footer_content');
        $this->dropForeignKey('fkFooter_to_graphic_publishes', 'footer_content');
        $this->dropTable('footer_content');
    }
}

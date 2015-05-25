<?php

use yii\db\Schema;
use yii\db\Migration;

class m150525_123858_add_seoname_into_category_for_level_one extends Migration
{
    public function up()
    {
        $this->addColumn('category', 'seoname', Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "для разбора данных по friendly seo urls" AFTER name');
        \common\components\UrlEncriptor::setupSeonamesForCategory();
    }

    public function down()
    {
       $this->dropColumn('category', 'seoname');
    }
    
}

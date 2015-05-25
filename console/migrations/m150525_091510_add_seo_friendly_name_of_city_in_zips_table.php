<?php

use yii\db\Schema;
use yii\db\Migration;


class m150525_091510_add_seo_friendly_name_of_city_in_zips_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('zips', 'seoname', Schema::TYPE_STRING . ' DEFAULT NULL COMMENT "для разбора данных по friendly seo urls" AFTER city');
        \common\components\UrlEncriptor::setupSeonamesForZips();
    }

    public function safeDown()
    {
        $this->dropColumn('zips', 'seoname');
    }
    
}

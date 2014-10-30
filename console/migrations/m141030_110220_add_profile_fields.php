<?php

use yii\db\Schema;
use yii\db\Migration;

class m141030_110220_add_profile_fields extends Migration
{
    public function up()
    {
        $this->addColumn("profile", "first_name", "varchar(255) DEFAULT NULL");
        $this->addColumn("profile", "last_name", "varchar(255) DEFAULT NULL");
        $this->addColumn("profile", "phone", "varchar(64) DEFAULT NULL COMMENT 'Phone number'");
        $this->addColumn("profile", "adress_mailing", "varchar(255) DEFAULT NULL COMMENT 'Mailing adress'");
        $this->addColumn("profile", "adress_billing", "varchar(255) DEFAULT NULL COMMENT 'Billing adress'");
        $this->addColumn("profile", "paypal", "varchar(64) DEFAULT NULL COMMENT 'Paypall account'");
        $this->addColumn("profile", "another_payment", "varchar(255) DEFAULT NULL COMMENT 'Another Payment, if user do not have a Paypal'");
        $this->addColumn("profile", "self_description", "varchar(255) DEFAULT NULL COMMENT 'Description about user'");
        $this->addColumn("profile", "photo", "varchar(255) DEFAULT NULL COMMENT 'Path to the photo'");
        $this->addColumn("profile", "country_code", "varchar(255) DEFAULT NULL COMMENT 'Country code'");
    }

    public function down()
    {
        $this->dropColumn("profile", "first_name");
        $this->dropColumn("profile", "last_name");
        $this->dropColumn("profile", "phone");
        $this->dropColumn("profile", "adress_mailing");
        $this->dropColumn("profile", "adress_billing");
        $this->dropColumn("profile", "paypal");
        $this->dropColumn("profile", "another_payment");
        $this->dropColumn("profile", "self_description");
        $this->dropColumn("profile", "photo");
        $this->dropColumn("profile", "country_code");
    }
}

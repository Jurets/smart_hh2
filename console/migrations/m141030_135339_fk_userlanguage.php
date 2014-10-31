<?php
/**
*  add foreign keys for table 'user_language'
*/

use yii\db\Schema;
use yii\db\Migration;
use common\modules\user\models\User;

class m141030_135339_fk_userlanguage extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("FK_userlanguage_user", 'user_language', 'user_id', User::tableName(), 'id');
        $this->addForeignKey("FK_userlanguage_language", 'user_language', 'language_id', 'language', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey("FK_userlanguage_user", 'user_language');
        $this->dropForeignKey("FK_userlanguage_language", 'user_language');
    }
}

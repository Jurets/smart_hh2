<?php
/**
*  add foreign keys for table 'user_verification'
*/

use yii\db\Schema;
use yii\db\Migration;
use common\modules\user\models\User;

class m141030_142921_fk_userverification extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("FK_userverification_user", 'user_verification', 'user_id', User::tableName(), 'id');
        $this->addForeignKey("FK_userverification_verification", 'user_verification', 'file_id', 'files', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey("FK_userverification_user", 'user_verification');
        $this->dropForeignKey("FK_userverification_verification", 'user_verification');
    }
}

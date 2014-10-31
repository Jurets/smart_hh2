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
        $this->addForeignKey("FK_userdiploma_user", 'user_diploma', 'user_id', User::tableName(), 'id');
        $this->addForeignKey("FK_userdiploma_diploma", 'user_diploma', 'file_id', 'files', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey("FK_userdiploma_user", 'user_diploma');
        $this->dropForeignKey("FK_userdiploma_diploma", 'user_diploma');
    }
}

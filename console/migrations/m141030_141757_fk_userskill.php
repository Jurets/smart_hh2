<?php
/**
*  add foreign keys for table 'user_language'
*/

use yii\db\Schema;
use yii\db\Migration;
use common\modules\user\models\User;

class m141030_141757_fk_userskill extends Migration
{
    public function up()
    {
        $this->addForeignKey("FK_userskill_user", 'user_skill', 'user_id', User::tableName(), 'id');
        $this->alterColumn('user_skill', 'skill_id', "INT(11) NOT NULL COMMENT 'ИД навыка'");
        $this->addForeignKey("FK_userskill_skill", 'user_skill', 'skill_id', 'skill', 'id');
    }

    public function down()
    {
        $this->dropForeignKey("FK_userskill_user", 'user_skill');
        $this->dropForeignKey("FK_userskill_skill", 'user_skill');
    }
}

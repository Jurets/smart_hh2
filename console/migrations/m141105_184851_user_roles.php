<?php

use yii\db\Schema;
use yii\db\Expression;
use yii\db\Migration;
use common\modules\user\models\Role;

class m141105_184851_user_roles extends Migration
{
    public function safeUp()
    {
        $this->update(Role::tableName(), ['name'=>'Customer'], 'name = :name', [':name'=>'User']);
        //$this->insert(Role::tableName(), ['name'=>'Performer', 'create_time'=>date('Y-m-d H:i:s')]);
        $this->insert(Role::tableName(), ['name'=>'Performer', 'create_time'=>new Expression('NOW()')]);
    }

    public function down()
    {
        $this->update(Role::tableName(), ['name'=>'User'], 'name = :name', [':name'=>'Customer']);
        $this->delete(Role::tableName(), 'name = :name', [':name'=>'Performer']);
    }
}

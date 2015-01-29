<?php

use yii\db\Schema;
use yii\db\Migration;

class m150129_072756_add_filesmodel_moderation_field extends Migration
{
    public function up()
    {
        $this->addColumn('files', 'moderate', Schema::TYPE_SMALLINT . ' DEFAULT 0 COMMENT "moderation signature: 0 - frontend access disabled 1 - enabled"');
    }

    public function down()
    {
        $this->dropColumn('files', 'moderate');
    }
}

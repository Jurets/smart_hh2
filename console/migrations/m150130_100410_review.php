<?php

use yii\db\Schema;
use yii\db\Migration;

class m150130_100410_review extends Migration
{
    public function up()
    {
        $this->createTable('review', [
            'id' => 'pk',
            'from_user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "who writes this review"',
            'to_user_id'  => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "whom write this review"',
            'date' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "when this was created"',
            'message' => Schema::TYPE_TEXT . ' DEFAULT NULL COMMENT "review content"',
            'rating' => Schema::TYPE_SMALLINT . ' DEFAULT NULL COMMENT "rating affixed user rating"'
        ]);
        $this->addForeignKey('fk_review_fromUser', 'review', 'from_user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('fk_review_toUser', 'review', 'to_user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_review_fromUser', 'review');
        $this->dropForeignKey('fk_review_toUser', 'review');
        $this->dropTable('review');                
    }
}

<?php

use yii\db\Schema;
use yii\db\Migration;

class m150223_134916_create_table_notification extends Migration
{
    public function safeUp()
    {
        $this->createTable('notification', [
            'id' => 'pk',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "user who will be notified"',
            'message' => Schema::TYPE_STRING . '(512) NOT NULL COMMENT "message to display"',
            'link' => Schema::TYPE_STRING . '(512) NOT NULL COMMENT "link to view more"',
            'type' => Schema::TYPE_STRING . ' NOT NULL COMMENT "type of notification"',
            'date' => Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP COMMENT "when this notification was created"',
            'is_read' => Schema::TYPE_SMALLINT . ' DEFAULT 0 COMMENT "is notification read by user"',
            'entity' => Schema::TYPE_STRING . ' NULL COMMENT "table name this notification is caused by"',
            'entity_id' => Schema::TYPE_INTEGER . ' NULL COMMENT "id of entity this notification is caused by"',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->addForeignKey('fk_notification_user', 'notification', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('notification');
    }
}

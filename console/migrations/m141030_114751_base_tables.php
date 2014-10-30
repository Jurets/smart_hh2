<?php

use yii\db\Schema;
use yii\db\Migration;

class m141030_114751_base_tables extends Migration
{
    private $sqlUp = array(
        "CREATE TABLE IF NOT EXISTS `category` (
          `id` int(11) NOT NULL,
          `name` varchar(255) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='категория объявления';",
        
        "CREATE TABLE IF NOT EXISTS `language` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL COMMENT 'название языка',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='языки' ;",
        
        "CREATE TABLE IF NOT EXISTS `skill` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL COMMENT 'название отрасли',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='экспертные области (отрасли)' ;",
        
        "CREATE TABLE IF NOT EXISTS `user_language` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user_id` int(11) NOT NULL COMMENT 'ИД юзера',
          `language_id` int(11) NOT NULL COMMENT 'ИД языка',
          `knowledge` int(1) NOT NULL COMMENT 'уровень владения (от 1 до 5)',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='юзер владеет языками' ;",
        
        "CREATE TABLE IF NOT EXISTS `user_skill` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user_id` int(11) NOT NULL COMMENT 'ИД юзера',
          `skill_id` varchar(255) NOT NULL COMMENT 'ИД отрасли',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='отрасли деятельности юзера' ;",
        
        "CREATE TABLE IF NOT EXISTS `user_verification` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user_id` int(11) NOT NULL COMMENT 'ИД юзера',
          `file_id` int(11) NOT NULL COMMENT 'ИД файла (картинки)',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='верительные грамоты юзера' ;",
        
        "CREATE TABLE IF NOT EXISTS `user_diploma` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user_id` int(11) NOT NULL COMMENT 'ИД юзера',
          `file_id` int(11) NOT NULL COMMENT 'ИД файла (картинки)',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Лицензии/дипломы юзера' ;",
        
        "CREATE TABLE IF NOT EXISTS `files` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          `code` char(32) NOT NULL,
          `size` int(11) NOT NULL,
          `mimetype` varchar(64) DEFAULT NULL,
          `description` varchar(512) DEFAULT NULL,
          `user_id` int(11) DEFAULT NULL COMMENT 'ид юзера владельца',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='загружаемые ресурсы (картинки)' ;",
        
        "CREATE TABLE IF NOT EXISTS `ticket` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `user_id` int(11) NOT NULL,
          `id_category` int(11) NOT NULL,
          `description` text NOT NULL,
          `title` varchar(255) NOT NULL,
          `price` int(11) DEFAULT NULL,
          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `is_turned_on` tinyint(4) NOT NULL,
          `system_key` varchar(255) DEFAULT NULL,
          `status` tinyint(4) DEFAULT NULL,
          `is_time_enable` tinyint(4) NOT NULL,
          `start_day` date DEFAULT NULL,
          `finish_day` date DEFAULT NULL,
          `performer_id` tinyint(4) DEFAULT NULL,
          `comment` text,
          `is_positive` tinyint(4) DEFAULT NULL,
          `rate` tinyint(4) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;",
    );
    
    private $sqlDown = array(
        "DROP TABLE IF EXIST `ticket`",
        "DROP TABLE IF EXIST `files`",
        "DROP TABLE IF EXIST `user_diploma`",
        "DROP TABLE IF EXIST `user_verification`",
        "DROP TABLE IF EXIST `user_skill`",
        "DROP TABLE IF EXIST `user_language`",
        "DROP TABLE IF EXIST `skill`",
        "DROP TABLE IF EXIST `language`",
        "DROP TABLE IF EXIST `category`",
    );
    
    public function safeUp()
    {
        foreach ($this->sqlUp as $sql) {
            $this->execute($sql);
        }
    }

    public function down()
    {
        foreach ($this->sqlDown as $sql) {
            $this->execute($sql);
        }
        //echo "m141030_114751_base_tables cannot be reverted.\n";
        //return false;
    }
}

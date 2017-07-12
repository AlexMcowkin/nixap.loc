<?php

use yii\db\Migration;

class m170712_133201_create_tables extends Migration
{
    public function safeUp()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $dbType = $this->db->driverName;
        $tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        $tableOptions_mssql = "";
        $tableOptions_pgsql = "";
        $tableOptions_sqlite = "";
        
        /* MYSQL */
        if (!in_array('users', $tables))  { 
            if ($dbType == "mysql") {
                $this->createTable('{{%users}}', [
                    'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'child_name' => 'VARCHAR(20) NOT NULL',
                    'parent_name' => 'VARCHAR(20) NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('users_tree', $tables))  { 
            if ($dbType == "mysql") {
                $this->createTable('{{%users_tree}}', [
                    'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'child_id' => 'INT(10) UNSIGNED NOT NULL',
                    'parent_id' => 'INT(10) UNSIGNED NOT NULL',
                ], $tableOptions_mysql);
            }
        }


        $this->createIndex('idx_child_id_8552_00','users_tree','child_id',0);
        $this->createIndex('idx_parent_id_8552_01','users_tree','parent_id',0);

        $this->execute('SET foreign_key_checks = 0');
        $this->addForeignKey('fk_users_8542_00','{{%users_tree}}', 'parent_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE' );
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function safeDown()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `users`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `users_tree`');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

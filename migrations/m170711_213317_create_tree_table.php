<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tree`.
 */
class m170711_213317_create_tree_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $dbType = $this->db->driverName;
        $tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        $tableOptions_mssql = "";
        $tableOptions_pgsql = "";
        $tableOptions_sqlite = "";
        /* MYSQL */
        if (!in_array('tree', $tables))  { 
            if ($dbType == "mysql") {
                $this->createTable('{{%tree}}', [
                    'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'my_name' => 'VARCHAR(20) NOT NULL',
                    'parent_name' => 'VARCHAR(20) NOT NULL',
                ], $tableOptions_mysql);
            }
        }
 
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `tree`');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

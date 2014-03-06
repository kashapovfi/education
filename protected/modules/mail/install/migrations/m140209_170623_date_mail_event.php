<?php

class m140209_170623_date_mail_event extends CDbMigration
{
    private $_tableName = '{{mail_mail_event}}';

    public function safeUp()
    {
        $this->addColumn($this->_tableName, 'date', 'date AFTER `id`');
        $this->addColumn($this->_tableName, 'every_month', 'tinyint(1) default "0" AFTER `date`');

        $this->dropColumn($this->_tableName, 'code');
        $this->dropColumn($this->_tableName, 'description');
    }

    public function safeDown()
    {
        echo 'Not supported down';
        return false;
    }
}
<?php

/*
 * APP_Points MODEL
 * A simple model for incrementing points and getting current values.
 * It extends Zend_Db_Table_Abstract so we can use Zend's OO interface
 * to the database.
 */

class APP_Points extends Zend_Db_Table_Abstract
{
    public $_name = 'points';
    static $table_name = 'points';
    static $incrementValue = 5;


    public function increment($id)
    {
        $data = array(
            'points' => new Zend_Db_Expr('`points`+'.APP_Points::$incrementValue),
        );
        $where[] = $this->getAdapter()->quoteInto('id = ?', $id);
        $result = $this->update($data,$where);
        return $result;
    }

    public function readAll()
    {
        $rows = $this->fetchAll();
        return $rows->toArray();
    }
}
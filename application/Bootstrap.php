<?php

/*
 * Put all the bootstrapping in here.
 */

// Lazy DB Connection
$adapterOptions = array( Zend_Db::AUTO_QUOTE_IDENTIFIERS => false );
$db = Zend_Db::factory(
    'PDO_MYSQL',
    array(
        'host'     => '127.0.0.1',
        'username' => 'username',
        'password' => 'password',
        'dbname'   => 'prog_chal',
        'options'  => $adapterOptions
    )
);
Zend_Db_Table_Abstract::setDefaultAdapter($db);
unset($adapterOptions);

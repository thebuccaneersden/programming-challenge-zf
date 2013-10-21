<?php

/**
 * Zend Front controller
 */

// Start Zend
set_include_path(
    '../library/ZendFramework-1.11.1/library/'
    . PATH_SEPARATOR . '../application/models/'
    . PATH_SEPARATOR . '../application/helpers/'
    . PATH_SEPARATOR . get_include_path()
);

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()->registerNamespace('APP');
Zend_Controller_Action_HelperBroker::addPrefix('APP');

// Keeping this project simple, so I'm using a simple bootstrapper and avoiding Zend_Application
include('../application/Bootstrap.php');

// Initialise MVC
Zend_Layout::startMvc();
Zend_Layout::getMvcInstance()->getView()->doctype(Zend_View_Helper_Doctype::XHTML1_STRICT);

// Front controller
$frontController  = Zend_Controller_Front::getInstance();
$frontController->throwExceptions(true); // because this is a programming challenge, not a production code

// Change the default controller
$frontController->setDefaultModule('frontend');

// Define modules folder
$frontController->addModuleDirectory('../application/modules');

// MVC Dispatch
try {
    $frontController->dispatch();
} catch (Exception $e) {
    // handle exceptions yourself
    echo "<pre>" . $e->getMessage() . "</pre>";
    var_dump($e);
}

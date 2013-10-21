<?php
/**
 * Frontend error controller
 */
 
/*
 * 400 Bad Request
 * 401 Unauthorized
 * 403 Forbidden
 * 404 Not Found
 * 405 Method Not Allowed
 * 406 Not Acceptable
 * 408 Request Timeout
 * 409 Conflict
 * 414 Request-URI Too Long
 * 500 Internal Server Error
 * 501 Not Implemented
 * 503 Service Unavailable
 */

class ErrorController extends Zend_Controller_Action
{
    function init() {}
    
    public function preDispatch() {}
    
    public function indexAction() {}

    public function errorAction() {}

    public function notfoundAction() {}
}
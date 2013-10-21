<?php

class AjaxController extends Zend_Controller_Action
{
    public function postDispatch()
    {
        parent::postDispatch();
    }
    
    public function preDispatch()
    {
    	$this->setNoCaching();
    	$this->setEmptyLayout();
    }

    public function indexAction() {}
 
    public function submitAction()
    {
    	if ($this->_request->isGet())
    	{
            $id = $this->_request->getParam('id');
            if ( empty($id) || !is_numeric($id) || $id < 0 )
            {
                header('HTTP/1.1 500 Internal Server Error');
            }
            // Update the score
            $points = new APP_Points();
            $result = $points->increment( $this->_request->getParam('id') );
            if( !$result )
            {
                header('HTTP/1.1 500 Internal Server Error');
            }
    	} else
    	{
            header("10.4.6 405 Method Not Allowed");
            header('Allow: GET', true, 405);
    	}
    }

    public function pollAction()
    {
        if ($this->_request->isGet())
        {
            $points = new APP_Points();
            $currentScore = $points->readAll();
            $json = Zend_Json::encode($currentScore);
            print($json);
            die();
        } else
        {
            header("10.4.6 405 Method Not Allowed");
            header('Allow: GET', true, 405);
        }
    }

    private function setEmptyLayout()
    {
        $this->_helper->layout()->setLayout('empty');
        header('Content-Type: text/html; charset=UTF-8');
    }
    
    private function setNoCaching()
    {
        header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' ); 
        header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' ); 
        header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
        header( 'Cache-Control: post-check=0, pre-check=0', false ); 
        header( 'Pragma: no-cache' );
    }

}

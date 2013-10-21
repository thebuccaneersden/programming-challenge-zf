<?php

class IndexController extends Zend_Controller_Action
{
    public function postDispatch()
    {
        parent::postDispatch();
    }
    
    public function preDispatch() {}

    public function indexAction()
    {
        $this->setDefaultLayout();
    }

    private function setEmptyLayout()
    {
        $this->_helper->layout->setLayout('empty');
        header('Content-Type: text/html; charset=UTF-8');
    }

    private function setDefaultLayout()
    {
        $this->view->headTitle('Leaderboard')
                   ->headTitle($this->_request->getActionName())
                   ->headTitle($this->_request->getControllerName())
                   ->setSeparator(' / ');
           
        $this->view->headLink()->appendStylesheet('/bootstrap/css/bootstrap.css');
        $this->view->headLink()->appendStylesheet('/css/application.css');

        $this->view->headScript()->appendFile('/jquery/jquery-1.9.0.min.js');
        $this->view->headScript()->appendFile('/bootstrap/js/bootstrap.js');
        $this->view->headScript()->appendFile('/js/application.js');

        $this->view->headMeta()->setHttpEquiv('Content-Type', 'text/html; charset=utf-8');
        header('Content-Type: text/html; charset=UTF-8');
    }
    
}

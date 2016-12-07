<?php

class API_VisitsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $apiData = new API_Model_VisitsDBMapper();
        $this->view->entries = $apiData->fetchAll();
    }

    public function getAction()
    {
        // action body
        $apiData = new API_Model_VisitsDBMapper();
        $this->view->entries = $apiData->getById();
    }


}

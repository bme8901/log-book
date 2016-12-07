<?php

class API_PeopleController extends Zend_Controller_Action
{


    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        /*$request = Zend_Controller_Front::getQuery();
        print_r($request);
        */
        /*$params = $this->_request->getParams();
        print_r($params);*/
        $apiData = new API_Model_FriendsDBMapper();
        $this->view->entries = $apiData->fetchAll();

    }

    public function getAction()
    {
        $apiData = new API_Model_FriendsDBMapper();
        $this->view->entries = $apiData->getById();

    }


}

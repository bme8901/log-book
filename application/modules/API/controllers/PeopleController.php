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
        $apiData = new API_Model_FriendsDBMapper();
        $this->view->entries = $apiData->fetchAll();

    }


}

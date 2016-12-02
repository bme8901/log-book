<?php

class API_FriendDBController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $friends = new API_Model_FriendsDBMapper();
        $this->view->entries = $friends->fetchAll();
    }


}

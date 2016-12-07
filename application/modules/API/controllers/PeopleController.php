<?php


class API_PeopleController extends Zend_Controller_Action
{


    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        //$autoloader = Zend_Loader_Autoloader::getInstance();
        //$autoloader->registerNamespace('Zend_');
        $method = new Zend_Controller_Request_Http();
        if($method->getMethod() == 'GET'){
            $apiData = new API_Model_FriendsDBMapper();
            $this->view->entries = $apiData->fetchAll();
        }elseif($method->getMethod() == 'POST'){
            $apiData = new API_Model_FriendsDBMapper();
            $this->view->entries = $apiData->insertPerson();
        }else{
          /* Throw Exception */
        }

    }

    public function getAction()
    {
        $apiData = new API_Model_FriendsDBMapper();
        $this->view->entries = $apiData->getById();

    }


}

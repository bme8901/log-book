<?php


class API_PeopleController extends Zend_Controller_Action
{


    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $method = new Zend_Controller_Request_Http();
        if($method->getMethod() == 'GET'){

            $apiData = new API_Model_FriendsDBMapper();
            $this->view->entries = $apiData->fetchAll();

        }elseif($method->getMethod() == 'POST'){

            $params = new Zend_Controller_Request_Http();
            $data = $params->getPost();
            $friend = new API_Model_FriendsDB();
            $friend    ->setFirstName($data['_fname'])
                       ->setLastName($data['_lname'])
                       ->setFavFood($data['_favfood']);
            $apiData = new API_Model_FriendsDBMapper();
            $apiData->save($friend);

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

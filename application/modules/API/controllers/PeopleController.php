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
            /*$apiData = new API_Model_FriendsDBMapper();
            $this->view->entries = $apiData->save();*/
            $params = new Zend_Controller_Request_Http();
            $data = $params->getPost();
            $friend = new API_Model_FriendsDB();
            $apiData = new API_Model_FriendsDBMapper();
            $apiData->save($friend);
            //instance Zend_Form, API_Form_People()
            //**set values** setElement()
            //API_Form_People Person() -> API_Model_FriendsDBMapper\save();

        }else{
          /* Throw Exception */
        }

    }

    public function getAction()
    {
        $apiData = new API_Model_FriendsDBMapper();
        $this->view->entries = $apiData->getById();

    }

    public function postAction()
    {
        $params = new Zend_Controller_Request_Http();
        $params->getRawBody();
        echo $params;
        /*$form    = new API_Form_Person();
        $comment = new Application_Model_FriendsDB($form->getValues());
        $mapper  = new Application_Model_FriendsDBMapper();
        $mapper->save($comment);
        return $this->_helper->redirector('index');*/
        }

        //$this->view->form = $form;
        //}
    //}

}

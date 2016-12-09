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
        $method = new Zend_Controller_Request_Http();
        if($method->getMethod() == 'GET'){
            $apiData = new API_Model_VisitsDBMapper();
            $this->view->entries = $apiData->fetchAll();

        }elseif($method->getMethod() == 'POST'){

            $params = new Zend_Controller_Request_Http();
            $data = $params->getPost();
            print_r($data);
            $visit = new API_Model_VisitsDB();
            $visit    ->setPerson($data['person-add'])
                       ->setDate($data['date-vis'])
                       ->setState($data['state-vis']);
            $apiData = new API_Model_VisitsDBMapper();
            $apiData->save($visit);

        }else{
          /* Throw Exception */
        }
    }

    public function getAction()
    {
        // action body
        $apiData = new API_Model_VisitsDBMapper();
        $this->view->entries = $apiData->getById();
    }


}

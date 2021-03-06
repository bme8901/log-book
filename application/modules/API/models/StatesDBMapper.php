<?php

class API_Model_StatesDBMapper
{
  protected $_dbTable;

  public function setDbTable($dbTable)
  {
    if (is_string($dbTable)){
      $dbTable = new $dbTable();
    }
    if (!$dbTable instanceof Zend_Db_Table_Abstract){
      throw new Exception('Invalid table data gateway provided');
    }
  $this->_dbTable = $dbTable;
  return $this;
  }

  public function getDbTable()
  {
    if (null === $this->_dbTable){
      $this->setDbTable('API_Model_DbTable_StatesDB');
    }
    return $this->_dbTable;
  }

    public function getById(){

      $requestURI = parse_url($_SERVER['REQUEST_URI']);
      $segments = explode('/', $requestURI['path']);
      $apiVars = [];

      $i = 2;
      while($i < count($segments)) {
        if($segments[$i+1]) {
        $apiVars[$segments[$i]] = $segments[$i+1];
        $i += 2;
        } else {
        $apiVars[$segments[$i]] = null;
        $i++;
        }
      }

        $result = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($result as $row) {
            $entry = new API_Model_StatesDB();
            $entry->setId($row->id_s)
                  ->setStateAbb($row->state_abb)
                  ->setStateName($row->state_name);
            $entries[] = $entry;
        }


        foreach($entries as $entryobj){
          if($apiVars['states'] == $entryobj->id){
          $resultArray[] = [
            'id'        => $entryobj->id,
            'stateabb'  => $entryobj->stateabb,
            'statename' => $entryobj->statename
          ];
      }
    }

        echo json_encode($resultArray, JSON_PRETTY_PRINT);

    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new API_Model_StatesDB();
            $entry->setId($row->id_s)
                  ->setStateAbb($row->state_abb)
                  ->setStateName($row->state_name);
            $entries[] = $entry;
        }

        foreach($entries as $entryobj){
          $resultArray[] = [
            'id'        => $entryobj->id,
            'stateabb'  => $entryobj->stateabb,
            'statename' => $entryobj->statename
          ];
        }

        echo json_encode($resultArray, JSON_PRETTY_PRINT);

    }

}

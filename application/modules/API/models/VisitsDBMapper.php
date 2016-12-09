<?php

class API_Model_VisitsDBMapper
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
      $this->setDbTable('API_Model_DbTable_VisitsDB');
    }
    return $this->_dbTable;
  }

  public function save(API_Model_VisitsDB $visit)
  {
        $data = array(
            'id_v'       => $visit->getId(),
            'person_id'  => $visit->getPerson(),
            'state_id'   => $visit->getState(),
            'date_id'    => $visit->getDate()
        );

        if (null === ($id = $visit->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
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
            $entry = new API_Model_VisitsDB();
            $entry->setId($row->id_v)
                  ->setPerson($row->person_id)
                  ->setState($row->state_id)
                  ->setDate($row->date_id);
            $entries[] = $entry;
        }


        foreach($entries as $entryobj){
          if($apiVars['visits'] == $entryobj->person){
          $resultArray[] = [
            'id'     => $entryobj->id,
            'person' => $entryobj->person,
            'state'  => $entryobj->state,
            'date'   => $entryobj->date
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
            $entry = new API_Model_VisitsDB();
            $entry->setId($row->id_v)
                  ->setPerson($row->person_id)
                  ->setState($row->state_id)
                  ->setDate($row->date_id);
            $entries[] = $entry;
        }

        foreach($entries as $entryobj){
          $resultArray[] = [
            'id'     => $entryobj->id,
            'person' => $entryobj->person,
            'state'  => $entryobj->state,
            'date'   => $entryobj->date
          ];
      }

        echo json_encode($resultArray, JSON_PRETTY_PRINT);

    }

}

<?php

class API_Model_FriendsDBMapper
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
      $this->setDbTable('API_Model_DbTable_FriendsDB');
    }
    return $this->_dbTable;
  }

  public function save(API_Model_FriendsDB $friend)
    {
        $data = array(
            'id'        => $friend->getId(),
            'firstname' => $friend->getFirstName(),
            'lastname'  => $friend->getLastName(),
            'favfood'   => $friend->getLastName()
        );

        if (null === ($id = $friend->getId())) {
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
            $entry = new API_Model_FriendsDB();
            $entry->setId($row->id_p)
                  ->setFirstName($row->first_name)
                  ->setLastName($row->last_name)
                  ->setFavFood($row->fav_food);
            $entries[] = $entry;
        }


        foreach($entries as $entryobj){
          if($apiVars['people'] == $entryobj->id){
          $resultArray[] = [
            'id'        => $entryobj->id,
            'firstname' => $entryobj->firstname,
            'lastname'  => $entryobj->lastname,
            'fav food'  => $entryobj->favfood
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
            $entry = new API_Model_FriendsDB();
            $entry->setId($row->id_p)
                  ->setFirstName($row->first_name)
                  ->setLastName($row->last_name)
                  ->setFavFood($row->fav_food);
            $entries[] = $entry;
        }

        foreach($entries as $entryobj){
          $resultArray[] = [
            'id'        => $entryobj->id,
            'firstname' => $entryobj->firstname,
            'lastname'  => $entryobj->lastname,
            'fav food'  => $entryobj->favfood
          ];
        }

        echo json_encode($resultArray, JSON_PRETTY_PRINT);

    }

}

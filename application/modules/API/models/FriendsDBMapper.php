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

  public function save(API_Model_FriendsDB $friends)
    {
        $data = array(
            'id'   => $friends->getId(),
            'food' => $friends->getFavFood(),
            'created' => date('Y-m-d H:i:s'),
        );

        if (null === ($id = $friends->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, API_Model_FriendsDB $friends)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $friends->setId($row->id_p)
                ->setFirstName($row->first_name)
                ->setLastName($row->last_name)
                ->setFavFood($row->fav_food);
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

        $resultArray = [];
        foreach($entries as $entry) {
          $resultArray[] = [
            'firstname' => $entry->firstname,
          ]
        }
        //return $entries;
        print_r($entries);

    }

}

<?php

class API_Model_VisitsDB
{
  protected $_idv;
  protected $_personid;
  protected $_stateid;
  protected $_dateid;

  public function __construct(array $options = null)
  {
      if (is_array($options)) {
          $this->setOptions($options);
      }
  }

  public function __set($name, $value)
  {
      $method = 'set' . $name;
      if (('mapper' == $name) || !method_exists($this, $method)) {
          throw new Exception('Invalid property');
      }
      $this->$method($value);
  }

  public function __get($name)
  {
      $method = 'get' . $name;
      if (('mapper' == $name) || !method_exists($this, $method)) {
          throw new Exception('Invalid property');
      }
      return $this->$method();
  }

  public function setOptions(array $options)
  {
      $methods = get_class_methods($this);
      foreach ($options as $key => $value) {
          $method = 'set' . ucfirst($key);
          if (in_array($method, $methods)) {
              $this->$method($value);
          }
      }
      return $this;
  }

  public function setId($idv)
  {
      $this->_idv = (string) $idv;
      return $this;
  }

  public function getId()
  {
      return $this->_idv;
  }

  public function setPerson($personid)
  {
      $this->_personid = (string) $personid;
      return $this;
  }

  public function getPerson()
  {
      return $this->_personid;
  }


  public function setState($stateid)
  {
      $this->_stateid = (string) $stateid;
      return $this;
  }

  public function getState()
  {
      return $this->_stateid;
  }

  public function setDate($dateid)
  {
      $this->_dateid = (string) $dateid;
      return $this;
  }

  public function getDate()
  {
      return $this->_dateid;
  }
}

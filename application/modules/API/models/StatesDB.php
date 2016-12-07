<?php

class API_Model_StatesDB
{
  protected $_ids;
  protected $_stateabb;
  protected $_statename;

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

  public function setId($ids)
  {
      $this->_ids = (string) $ids;
      return $this;
  }

  public function getId()
  {
      return $this->_ids;
  }

  public function setStateAbb($stateabb)
  {
      $this->_stateabb = (string) $stateabb;
      return $this;
  }

  public function getStateAbb()
  {
      return $this->_stateabb;
  }


  public function setStateName($statename)
  {
      $this->_statename = (int) $statename;
      return $this;
  }

  public function getStateName()
  {
      return $this->_statename;
  }
}

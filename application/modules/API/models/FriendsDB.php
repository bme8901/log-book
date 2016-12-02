<?php

class API_Model_FriendsDB
{
      protected $_idp;
      protected $_firstname;
      protected $_lastname;
      protected $_favfood;

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
              throw new Exception('Invalid guestbook property');
          }
          $this->$method($value);
      }

      public function __get($name)
      {
          $method = 'get' . $name;
          if (('mapper' == $name) || !method_exists($this, $method)) {
              throw new Exception('Invalid guestbook property');
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

      public function setId($idp)
      {
          $this->_idp = (string) $idp;
          return $this;
      }

      public function getId()
      {
          return $this->_idp;
      }

      public function setFirstName($firstname)
      {
          $this->_firstname = (string) $firstname;
          return $this;
      }

      public function getFirstName()
      {
          return $this->_firstname;
      }

      public function setLastName($lastname)
      {
          $this->_lastname = $lastname;
          return $this;
      }

      public function getLastName()
      {
          return $this->_lastname;
      }

      public function setFavFood($favfood)
      {
          $this->_favfood = (int) $favfood;
          return $this;
      }

      public function getFavFood()
      {
          return $this->_favfood;
      }


}

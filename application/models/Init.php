<?php

class Application_Model_Init
{
  public function initializeDatabase(){

  $conn = mysqli_connect('127.0.0.1', 'root', 'root', 'partfour_base')
    or die ('Cannot connect to server');
  $con = mysqli_connect('127.0.0.1', 'root', 'root')
      or die ('Cannot connect to server');
  // Check for Database
  $_dbCreate = "CREATE DATABASE IF NOT EXISTS partfour_base";
    mysqli_query($conn, $_dbCreate);
  // Check for Tables and Populate
  $CreateTablePeople = "CREATE TABLE IF NOT EXISTS people (id_p INT PRIMARY KEY AUTO_INCREMENT, first_name TEXT, last_name TEXT, fav_food TEXT)";
    mysqli_query($conn, $CreateTablePeople);
  $CreateTableStates = "CREATE TABLE IF NOT EXISTS states (id_s INT PRIMARY KEY, state_name TEXT, state_abb TEXT)";
  $CreateTenStates = "INSERT INTO states VALUES (1, 'Louisiana', 'LA'), (2, 'California', 'CA'), (3, 'New York', 'NY'), (4, 'Texas', 'TX'), (5, 'Florida', 'FL'), (6, 'Oregon', 'OR'), (7, 'Arkansas', 'AR'), (8, 'Alaska', 'AK'), (9, 'Arizona', 'AZ'), (10, 'Mississippi', 'MS')";
    mysqli_query($conn, $CreateTableStates);
    mysqli_query($conn, $CreateTenStates);
  $CreateTableVisits = "CREATE TABLE IF NOT EXISTS visits (id_v INT PRIMARY KEY AUTO_INCREMENT, person_id INT, state_id INT, date_id TEXT, FOREIGN KEY (person_id) REFERENCES people (id_p), FOREIGN KEY (state_id) REFERENCES states (id_s))";
    mysqli_query($conn, $CreateTableVisits);
    mysqli_close($conn);

  }

}

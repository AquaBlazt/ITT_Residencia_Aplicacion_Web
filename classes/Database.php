<?php

class Database
{
  public function getConn()
  {
    $db_host="localhost";
    $db_name="mascotas";
    $db_user="admin";
    $db_pass="-6gIU5ZdNF/LUh6_";

    $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';

    $conn = new PDO($dsn, $db_user, $db_pass);

    try {
    $db = new PDO($dsn, $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
    }
    catch (PDOException $e)
    {
      echo $e->getMessage();
      exit;
    }
  }
}
?>



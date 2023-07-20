<?php

class Database
{
  public static function getConn()
  {
    $db_host="localhost";
    $db_name="u614793440_idmascotas";
    $db_user="u614793440_idmascotas";
    $db_pass="Mascotas01";

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



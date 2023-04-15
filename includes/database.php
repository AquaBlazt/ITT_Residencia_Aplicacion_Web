<?php

function getDB()
{
$db_host="localhost";
$db_name="mascotas";
$db_user="admin";
$db_pass="-6gIU5ZdNF/LUh6_";

$conn= mysqli_connect($db_host ,$db_user ,$db_pass,$db_name);

if(mysqli_connect_error())
{
  echo mysqli_connect_error();
  exit;
}

return $conn;
}
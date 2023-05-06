<?php
/* En este archivo estaran todas las funciones relacionadas a registrar informacion en la BD */

function getRegistro($conn, $id)
{
$sql = "SELECT *
        FROM registro_mascota
        WHERE id= ?";
$stmt = mysqli_prepare($conn, $sql);

if($stmt === false)
{
  echo mysqli_error($conn);
}
else
{
mysqli_stmt_bind_param($stmt, "i" , $id);

if(mysqli_stmt_execute($stmt))
{
  $result = mysqli_stmt_get_result($stmt);
  return mysqli_fetch_array($result, MYSQLI_ASSOC);
}
}


}

function validateRegistro($pic, $serial_number, $mascot_name, $age, $gender, $sickness, $sterilized)
{
  $errors=[];

if($pic=='')
{
  $errors[]='Se requiere una foto de la mascota';
}
if($serial_number=='')
{
  $errors[]='Se requiere un numero de serie';
}
if($mascot_name=='')
{
  $errors[]='Se requiere el nombre de la mascota';
}
if($age=='')
{
  $errors[]='Se requiere la edad de la mascota';
}
if($gender=='')
{
  $errors[]='Se requiere el genero de la mascota';
}
if($sterilized=='')
{
  $errors[]='Se requiere saber si la mascota esta esterilizada';
}

return $errors;
}

?>
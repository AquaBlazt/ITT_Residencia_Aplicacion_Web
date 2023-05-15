<?php
require '\residencia\includes\database.php';
require '\residencia\includes\registro.php';
require '\residencia\includes\url.php';
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_GET['id'])) {

$registro_mascota = getRegistro($conn , $_GET['id']);

if($registro_mascota)
{
$id = $registro_mascota['id'];
$pic= $registro_mascota['pic'];
$serial_number=$registro_mascota['serial_number'];
$mascot_name=$registro_mascota['mascot_name'];
$age=$registro_mascota['age'];
$gender=$registro_mascota['gender'];
$sickness=$registro_mascota['sickness'];
$sterilized=$registro_mascota['sterilized'];
}

else
{
  die("La informacion no se encontro");
}

} else 

{
 die("ID invalido, la informacion no se encontro");
}
mysqli_report(MYSQLI_REPORT_OFF);
$sql= "DELETE FROM registro_mascota       
      WHERE id= ? ";
 
$stmt= mysqli_prepare($conn, $sql);

if($stmt===false)
{
  echo mysqli_error($conn);
}
else
{

  mysqli_stmt_bind_param($stmt, "i", $id);  
if(mysqli_stmt_execute($stmt))
{

redirect("/site/lista_mascotas.php?id=$id");

}
else
{
if ($conn->errno === 1062) {
  $errors[]="Ya existe un registro con el num. de serie introducido";
} else {
  die($conn->error . " " . $conn->errno);
}

}
}
?>
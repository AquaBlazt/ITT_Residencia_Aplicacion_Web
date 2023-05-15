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

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$id = $registro_mascota['id'];
$pic = $_POST['pic'];
$serial_number= $_POST['serial_number'];
$mascot_name= $_POST['mascot_name'];
$age= $_POST['age'];
$gender= filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_INT);
$sickness= $_POST['sickness'];
$sterilized= filter_input(INPUT_POST, 'sterilized', FILTER_VALIDATE_INT);


$errors = validateRegistro($pic, $serial_number, $mascot_name, $age, $gender, $sickness, $sterilized);


if(empty($errors))
{
  
  mysqli_report(MYSQLI_REPORT_OFF);
    $sql= "UPDATE registro_mascota 
           SET pic= ?,
               serial_number= ?,
               mascot_name= ?,
               age= ?,
               gender= ?,
               sickness= ?,
               sterilized= ?
          WHERE id=?";
    
  
        
    $stmt= mysqli_prepare($conn, $sql);
    
    if($stmt===false)
    {
      echo mysqli_error($conn);
    }
    else
    {

      
  
      if($sickness=='')
      {
        $sickness = null;
      }
  
      mysqli_stmt_bind_param($stmt, "iisissii", $pic, $serial_number, $mascot_name,
      $age, $gender, $sickness, $sterilized, $id);  
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
}
}

?>

<?php require '\residencia\includes\header.php'; ?>
<title>Edicion de la Mascota</title>
<a href="menu.php">Menu</a>
<a href="lista_mascotas.php">Lista</a>
<h1>Editar</h1>
<?php require '\residencia\includes\registro_formulario_mascota.php'; ?>
<?php require '\residencia\includes\footer.php'; ?>
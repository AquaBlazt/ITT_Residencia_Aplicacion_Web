<?php
require '\residencia\includes\database.php';
require '\residencia\includes\registro.php';
require '\residencia\includes\url.php';

$pic='';
$serial_number='';
$mascot_name='';
$age='';
$gender='';
$sickness='';
$sterilized='';


if($_SERVER["REQUEST_METHOD"]=="POST")
{
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
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);
  $sql= "INSERT INTO registro_mascota (pic,serial_number,mascot_name,age,gender,sickness,sterilized)
  VALUES (?, ?, ?, ?, ?, ?, ?)";

      
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

    mysqli_stmt_bind_param($stmt, "iisissi", $pic, $serial_number, $mascot_name,
    $age, $gender, $sickness, $sterilized);  
if(mysqli_stmt_execute($stmt))
{
  $id = mysqli_insert_id($conn);
  redirect("/site/menu.php?id=$id");

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
    <a href="menu.php">Menu</a>
    <title>Registro de la Mascota</title>
<?php require '\residencia\includes\registro_formulario_mascota.php'; ?>
    <?php require '\residencia\includes\footer.php'; ?>

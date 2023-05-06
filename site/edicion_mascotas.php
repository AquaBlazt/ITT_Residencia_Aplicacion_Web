<?php
require '\residencia\includes\database.php';
require '\residencia\includes\registro.php';
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
die("Formulario valido");


}

}

?>

<?php require '\residencia\includes\header.php'; ?>
<title>Edicion de la Mascota</title>
<h1>Editar</h1>
<?php require '\residencia\includes\registro_formulario_mascota.php'; ?>
<?php require '\residencia\includes\footer.php'; ?>
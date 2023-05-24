<?php
require '\residencia\classes\Database.php';
require '\residencia\classes\ListaMascotas.php';
require '\residencia\includes\url.php';
require '\residencia\includes\auth.php';

session_start();

if(! isLoggedIn())
{
  die("No autorizado");
}

$ListaMascota = new ListaMascotas();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $db = new Database();
  $conn = $db->getConn();
  
  $ListaMascota->pic = $_POST['pic'];
  $ListaMascota->serial_number = $_POST['serial_number'];
  $ListaMascota->mascot_name = $_POST['mascot_name'];
  $ListaMascota->age = $_POST['age'];
  $ListaMascota->gender = filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_INT);
  $ListaMascota->sickness = $_POST['sickness'];
  $ListaMascota->sterilized = filter_input(INPUT_POST, 'sterilized', FILTER_VALIDATE_INT);
 
  if($ListaMascota->create($conn))
    {
    
    redirect("/site/lista_mascotas.php?id={$ListaMascota->id}");
    }
}

?>
 <?php require '\residencia\includes\header.php'; ?>
    <a href="menu.php">Menu</a>
    <title>Registro de la Mascota</title>
<?php require '\residencia\includes\registro_formulario_mascota.php'; ?>
    <?php require '\residencia\includes\footer.php'; ?>

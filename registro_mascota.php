<?php
require '\residencia\includes\init.php';
Auth::requireLogin();


$ListaMascota = new ListaMascotas();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $conn = require '\residencia\includes\db.php';
  
  $ListaMascota->usuario_id = $_POST['usuario_id'];
  $ListaMascota->pic = $_POST['pic'];
  $ListaMascota->serial_number = $_POST['serial_number'];
  $ListaMascota->mascot_name = $_POST['mascot_name'];
  $ListaMascota->age = $_POST['age'];
  $ListaMascota->gender = filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_INT);
  $ListaMascota->sickness = $_POST['sickness'];
  $ListaMascota->sterilized = filter_input(INPUT_POST, 'sterilized', FILTER_VALIDATE_INT);
 
  if($ListaMascota->create($conn))
    {
    
      Url::redirect("/lista_mascotas.php?id={$ListaMascota->id}");
    }
}

?>
 <?php require '\residencia\includes\header.php'; ?>
 <?php require '\residencia\includes\header.php'; ?>
  <a href="lista_mascotas.php">Mis mascotas</a>
    <title>Registro de la Mascota</title>
<?php require '\residencia\includes\registro_formulario_mascota.php'; ?>
    <?php require '\residencia\includes\footer.php'; ?>

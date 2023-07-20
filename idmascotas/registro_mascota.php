<?php
require 'includes/init.php';
Auth::requireLogin();


$ListaMascota = new ListaMascotas();
$userId = Auth::getUserId();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $conn = require 'includes/db.php';
  
  
  
  $ListaMascota->serial_number = $_POST['serial_number'];
  $ListaMascota->mascot_name = $_POST['mascot_name'];
  $ListaMascota->age = $_POST['age'];
  $ListaMascota->gender = filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_INT);
  $ListaMascota->sickness = $_POST['sickness'];
  $ListaMascota->sterilized = filter_input(INPUT_POST, 'sterilized', FILTER_VALIDATE_INT);
  $ListaMascota->phone_number = $_POST['phone_number'];
  $ListaMascota->usuario_id = $_POST['usuario_id'];
 
  if($ListaMascota->create($conn))
    {
    
      Url::redirect("/lista_mascotas.php?id={$ListaMascota->id}");
    }
}

?>
 <?php require 'includes/header.php'; ?>
  <a href="lista_mascotas.php">Mis mascotas</a>
    <title>Registro de la Mascota</title>
    <p>Tu ID de usuario es: <?= htmlspecialchars($userId) ?></p>
<?php require 'includes/registro_formulario_mascota.php'; ?>
    <?php require 'includes/footer.php'; ?>
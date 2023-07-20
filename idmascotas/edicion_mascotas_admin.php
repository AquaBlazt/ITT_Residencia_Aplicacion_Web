<?php
require 'includes/init.php';

Auth::requireLogin();
$conn = require 'includes/db.php';


if (isset($_GET['id'])) {
  
$ListaMascota = ListaMascotas::getByID($conn , $_GET['id']);

if(! $ListaMascota)
{
  die("La informacion no se encontro");
}

} else 
{
 die("ID invalido, la informacion no se encontro");
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  
  
  $ListaMascota->serial_number = $_POST['serial_number'];
  $ListaMascota->mascot_name = $_POST['mascot_name'];
  $ListaMascota->age = $_POST['age'];
  $ListaMascota->gender = filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_INT);
  $ListaMascota->sickness = $_POST['sickness'];
  $ListaMascota->phone_number = $_POST['phone_number'];
  $ListaMascota->sterilized = filter_input(INPUT_POST, 'sterilized', FILTER_VALIDATE_INT);
 

 
  if($ListaMascota->update($conn))
    {
    
      Url::redirect("/muestra_mascotas_admin.php?id={$ListaMascota->id}");
    }
}


?>

<?php require 'includes/header.php'; ?>

<title>Edicion de la Mascota</title>
<a href="lista_mascotas_admin.php">Lista de Mascotas</a>
<h1>Editar</h1>
<?php require 'includes/registro_formulario_mascota.php'; ?>
<?php require 'includes/footer.php'; ?>
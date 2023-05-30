<?php
require '\residencia\includes\init.php';


Auth::requireLogin();
$conn = require '\residencia\includes\db.php';

mysqli_report(MYSQLI_REPORT_OFF);

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
  
  $ListaMascota->pic = $_POST['pic'];
  $ListaMascota->serial_number = $_POST['serial_number'];
  $ListaMascota->mascot_name = $_POST['mascot_name'];
  $ListaMascota->age = $_POST['age'];
  $ListaMascota->gender = filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_INT);
  $ListaMascota->sickness = $_POST['sickness'];
  $ListaMascota->sterilized = filter_input(INPUT_POST, 'sterilized', FILTER_VALIDATE_INT);
 
  if($ListaMascota->update($conn))
    {
    
      Url::redirect("/lista_mascotas.php?id={$ListaMascota->id}");
    }
}

?>

<?php require '\residencia\includes\header.php'; ?>

<title>Edicion de la Mascota</title>
<a href="lista_mascotas.php">Mis mascotas</a>
<h1>Editar</h1>
<?php require '\residencia\includes\registro_formulario_mascota.php'; ?>
<?php require '\residencia\includes\footer.php'; ?>
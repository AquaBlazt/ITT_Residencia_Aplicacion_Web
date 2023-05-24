<?php
require '\residencia\classes\Database.php';
require '\residencia\classes\ListaMascotas.php';
require '\residencia\includes\url.php';


$db = new Database();
$conn= $db->getConn();
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
    
    redirect("/site/lista_mascotas.php?id={$ListaMascota->id}");
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
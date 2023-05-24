<?php
require '\residencia\classes\Database.php';
require '\residencia\classes\ListaMascotas.php';
require '\residencia\classes\Url.php';
require '\residencia\classes\Auth.php';

session_start();
if (! Auth::isLoggedIn()) {

  Url::redirect("/site/offline.php?id=$id");

}

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

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
if ($ListaMascota->delete($conn))
{
  Url::redirect("/site/lista_mascotas.php?id=$id");
}

}


?>

<?php require '\residencia\includes\header.php'; ?>
<h2> ¿Desea eliminar la informacion? </h2>
<form method="post">
  <p>¿Estas seguro en eliminar la informacion? </p>
    <button>Eliminar</button>
    <a href="muestra_mascotas.php?id=<?= $ListaMascota->id; ?>">Cancel</a>
</form>
<?php require '\residencia\includes\header.php'; ?>
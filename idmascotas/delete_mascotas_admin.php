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

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
if ($ListaMascota->delete($conn))
{
  Url::redirect("/lista_mascotas_admin.php?id=$id");
}

}


?>

<?php require 'includes/header.php'; ?>
<h2> ¿Desea eliminar la informacion? </h2>
<form method="post">
  <p>¿Estas seguro en eliminar la informacion? </p>
    <button>Eliminar</button>
    <a href="muestra_mascotas_admin.php?id=<?= $ListaMascota->id; ?>">Cancel</a>
</form>
<?php require 'includes/footer.php'; ?>
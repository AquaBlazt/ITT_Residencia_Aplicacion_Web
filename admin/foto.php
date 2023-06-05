<?php
require '\residencia\includes\init.php';

Auth::requireLogin();
$conn = require '\residencia\includes\db.php';


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

  var_dump($_FILES);

  try {

      if (empty($_FILES)) {
          throw new Exception('Invalido');
      }

      switch ($_FILES['file']['error']) {
          case UPLOAD_ERR_OK:
              break;

          case UPLOAD_ERR_NO_FILE:
              throw new Exception('Debe subir algo');
              break;

          case UPLOAD_ERR_INI_SIZE:
              throw new Exception('Archivo muy grande');
              break;

          default:
              throw new Exception('Error');
      }

      if ($_FILES['file']['size'] > 1000000) {
          throw new Exception('El archivo pesa mucho');
      }

  } catch (Exception $e) {
      echo $e->getMessage();
  }

 
 
}


?>

<?php require '\residencia\includes\header.php'; ?>

<h2>Foto de la Mascota</h2>

<form method="post" enctype="multipart/form-data">

    <div>
        <label for="file">Foto</label>
        <input type="file" name="file" id="file">
    </div>

    <button>Subir</button>
    <a href="/admin/muestra_mascotas.php?id=<?= $ListaMascota->id; ?>">Cancelar</a>


</form>

<?php require '\residencia\includes\footer.php'; ?>
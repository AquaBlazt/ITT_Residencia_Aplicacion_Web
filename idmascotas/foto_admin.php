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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   

    try {

        if (empty($_FILES)) {
            throw new Exception('Foto invalida');
        }

        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_OK:
                break;

            case UPLOAD_ERR_NO_FILE:
                throw new Exception('Favor de subir una foto');
                break;

            case UPLOAD_ERR_INI_SIZE:
                throw new Exception('El archivo es muy pesado(servidor)');
                break;

            default:
                throw new Exception('Error');
        }

        if ($_FILES['file']['size'] > 1000000) {

            throw new Exception('El archivo es muy pesado');

        }

       $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

       $finfo = finfo_open(FILEINFO_MIME_TYPE);
       $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

       if ( ! in_array($mime_type, $mime_types)) {

           throw new Exception('Formato de foto invalido');

       }

       $pathinfo = pathinfo($_FILES["file"]["name"]);

       $base = $pathinfo['filename'];

       $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

       $base = mb_substr($base, 0, 200);

       $filename = $base . "." . $pathinfo['extension'];

       $destination = "uploads/$filename";

       $i = 1;

       while (file_exists($destination)) {

           $filename = $base . "-$i." . $pathinfo['extension'];
           $destination = "uploads/$filename";

           $i++;
       }

       if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {

        $previous_image = $article->image_file;

           if ($ListaMascota->setImageFile($conn, $filename)) {

            if ($previous_image) {
                unlink("../uploads/$previous_image");
            }

            Url::redirect("/foto_admin.php?id={$ListaMascota->id}");            

           }

       } else {

           throw new Exception('Error, no se subio la foto');

       }

   } catch (Exception $e) {
       echo $e->getMessage();
   }
}

?>

<?php require 'includes/header.php'; ?>

<h2>Foto de la Mascota</h2>

<?php if ($ListaMascota->image_file) : ?>
    <img src="uploads/<?= $ListaMascota->image_file; ?>">
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

    <div>
        <label for="file">Foto</label>
        <input type="file" name="file" id="file">
    </div>

    <button>Subir</button>
    <a href="muestra_mascotas_admin.php?id=<?= $ListaMascota->id; ?>">Cancelar</a>


</form>

<?php require 'includes/footer.php'; ?>
<?php
require '\residencia\includes\database.php';
require '\residencia\includes\registro.php';
require '\residencia\includes\url.php';
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_GET['id'])) {

$registro_mascota = getRegistro($conn , $_GET['id'], 'id');

if($registro_mascota)
{
$id = $registro_mascota['id'];

}

else
{
  die("La informacion no se encontro");
}

} else 

{
 die("ID invalido, la informacion no se encontro");
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$sql= "DELETE FROM registro_mascota       
      WHERE id= ? ";
 
$stmt= mysqli_prepare($conn, $sql);

if($stmt===false)
{
  echo mysqli_error($conn);
}
else
{

  mysqli_stmt_bind_param($stmt, "i", $id);  
if(mysqli_stmt_execute($stmt))
{

redirect("/site/lista_mascotas.php?id=$id");

}
else
{
if ($conn->errno === 1062) {
  $errors[]="Ya existe un registro con el num. de serie introducido";
} else {
  die($conn->error . " " . $conn->errno);
}

    }
  }
}

?>
<?php require '\residencia\includes\header.php'; ?>

<h2> ¿Desea eliminar la informacion? </h2>
<form method="post">
  <p>¿Estas seguro en eliminar la informacion? </p>
    <button>Eliminar</button>
    <a href="muestra_mascotas.php?id=<?= $registro_mascota['id']; ?>">Cancelar</a>
<?php require '\residencia\includes\header.php'; ?>
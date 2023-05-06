<?php
session_start();
require '\residencia\includes\database.php';
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);

if(isset($_SESSION["user_id"]))
{
  $sql = "SELECT * FROM registro_usuario
          WHERE id = {$_SESSION["user_id"]}";

          $result = $conn->query($sql);

          $user =  $result->fetch_assoc();


}



?>


<!DOCTYPE html>
<html lang="esp">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/style.css" rel="stylesheet" />
    <title>Menu</title>
  </head>
  <body>
  <h1>Menu</h1>

<?php if (isset($user)): ?>

<p> Bienvenido <?= htmlspecialchars($user["name"]) ?></p>
        <a href="registro_mascota.php">Registro</a>          
        <a href="lista_mascotas.php">Lista de Mascotas</a>
        <a href="salir.php">Cerrar Sesion</a> 

      <?php else: ?>
       <p> Debes de Iniciar Sesion</p>
        <a href="inicio.php">Inicia sesion</a> <p> O si no estas registrado, crea tu cuenta ahora </p> <a href="registro_usuario.php"> Registrate </a>


        <?php endif; ?>
  </body>
</html>

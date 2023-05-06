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


<?php require '\residencia\includes\header.php'; ?>
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
        <?php require '\residencia\includes\footer.php'; ?>

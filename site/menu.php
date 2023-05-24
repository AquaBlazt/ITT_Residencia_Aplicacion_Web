<?php
require '\residencia\classes\Database.php';
require '\residencia\classes\Auth.php';

session_start();

$db = new Database();
$conn = $db->getConn();

mysqli_report(MYSQLI_REPORT_OFF);

?>


<?php require '\residencia\includes\header.php'; ?>


<?php if (Auth::isLoggedIn()): ?>
  <p>Estas conectado. <a href="logout.php">Cerrar Sesion</a></p>
  <h1>Bienvenido</h1>
  <p><a href="registro_mascota.php">Registro</a></p>         
    <p><a href="lista_mascotas.php">Lista de Mascotas</a></p>
  <?php else: ?>
 
    <p>Estas desconectado. <a href="login.php">Inicia Sesión</a></p>
    <p>Si no tienes cuenta, <a href ="registro_user.php">registrate aqui</a></p>

  <?php endif; ?>

    <title>Menu</title>
  </head>
  <body>
        <?php require '\residencia\includes\footer.php'; ?>

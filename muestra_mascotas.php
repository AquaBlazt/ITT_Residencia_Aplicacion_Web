<?php
require '\residencia\includes\init.php';

$conn = require '\residencia\includes\db.php';

mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_GET['id'])) 
{

$registro_mascota = ListaMascotas::getByID($conn, $_GET['id']);

}
 else 
{
    $registro_mascota = null;
}

?>

<?php require '\residencia\includes\header.php'; ?>
<?php if (Auth::isLoggedIn()): ?>
  <p>Estas conectado. <a href="logout.php">Cerrar Sesion</a></p>
  <p><a href="registro_mascota.php">Registro</a></p>  
  <title>Muestra de las mascotas registradas</title>
</head>
<body>
<?php if ($registro_mascota) : ?>
    <article>
        <h2><?= htmlspecialchars($registro_mascota->serial_number); ?></h2>
        <p><?= htmlspecialchars($registro_mascota->mascot_name); ?></p>
        <p><?= htmlspecialchars($registro_mascota->age); ?></p>
        <p><?= htmlspecialchars($registro_mascota->gender); ?></p>
        <p><?= htmlspecialchars($registro_mascota->sickness); ?></p>
        <p><?= htmlspecialchars($registro_mascota->sterilized); ?></p>
    </article>
 
   
<?php else : ?>
        <p>No se encontro ningun registro</p>
<?php endif; ?>
<?php else: ?>
 
 <p>Estas desconectado. <a href="login.php">Inicia Sesión</a></p>
 <p>Si no tienes cuenta, <a href ="registro_user.php">registrate aqui</a></p>

<?php endif; ?>
<?php require '\residencia\includes\footer.php'; ?>
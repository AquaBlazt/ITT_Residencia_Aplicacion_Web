<?php
require '\residencia\includes\init.php';
Auth::requireLogin();
$conn = require '\residencia\includes\db.php';


mysqli_report(MYSQLI_REPORT_OFF);

$registros_mascotas = ListaMascotas::getAll($conn);
?>

<?php require '\residencia\includes\header.php'; ?>
<?php if (Auth::isLoggedIn()): ?>
  <p>Estas conectado. <a href="logout.php">Cerrar Sesion</a></p>
  <h2>Bienvenido</h2>
  <p><a href="registro_mascota.php">Registro</a></p>  
  <title>Lista de mascotas</title>
</head>
<body>
<?php if (empty($registros_mascotas)): ?>
    <p>No hay ningun registro de mascotas.</p>
<?php else: ?>

    <ul>
        <?php foreach ($registros_mascotas as $registro): ?>
            <li>
                <article>
                    <h2><a href="muestra_mascotas.php?id=<?= $registro['id']; ?>"><?= htmlspecialchars($registro['serial_number']); ?></a></h2>
                    <p><?= htmlspecialchars($registro['mascot_name']); ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>
<?php else: ?>
 
 <p>Estas desconectado. <a href="login.php">Inicia Sesión</a></p>
 <p>Si no tienes cuenta, <a href ="registro_user.php">registrate aqui</a></p>

<?php endif; ?>
<?php require '\residencia\includes\footer.php'; ?>
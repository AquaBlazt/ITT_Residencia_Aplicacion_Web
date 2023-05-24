<?php
require '\residencia\classes\Database.php';
require '\residencia\classes\ListaMascotas.php';
require '\residencia\classes\Auth.php';

session_start();

$db = new Database();
$conn = $db->getConn();

mysqli_report(MYSQLI_REPORT_OFF);

$registros_mascotas = ListaMascotas::getAll($conn);
?>

<?php require '\residencia\includes\header.php'; ?>
<?php if (Auth::isLoggedIn()): ?>
  <p>Estas conectado. <a href="logout.php">Cerrar Sesion</a></p>
  <title>Lista de mascotas</title>
  <a href="menu.php">Menu</a>
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
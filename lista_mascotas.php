<?php
require '/residencia/includes/init.php';
Auth::requireLogin();

$conn = require '/residencia/includes/db.php';

$userId = 61; 
 
$registros_mascotas = ListaMascotas::userGetAll($conn, $userId);

?>

<?php require '/residencia/includes/header.php'; ?>
<title>Lista de mascotas</title>
</head>
<body>
<?php if (Auth::isLoggedIn()): ?>
    <p>Estás conectado. <a href="logout.php">Cerrar Sesión</a></p>
    <p>Tu ID de usuario es: <?= $userId ?></p>
 
    <h2>Bienvenido</h2>
    <p><a href="registro_mascota.php">Registro</a></p>  

    <?php if (empty($registros_mascotas)): ?>
        <p>No hay ningún registro de mascotas.</p>
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
    <p>Estás desconectado. <a href="login.php">Inicia Sesión</a></p>
    <p>Si no tienes cuenta, <a href="registro_user.php">regístrate aquí</a></p>
<?php endif; ?>

<?php require '/residencia/includes/footer.php'; ?>

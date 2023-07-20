<?php
require 'includes/init.php';
Auth::requireLogin();
$conn = require 'includes/db.php';


$userId = Auth::getUserId();
$registros_mascotas = ListaMascotas::userGetAll($conn, $userId);


?>

<?php require 'includes/header.php'; ?>
<title>Lista de mascotas</title>
</head>
<body>
<?php if (Auth::isLoggedIn()): ?>
    <p>Estás conectado. <a href="logout.php">Cerrar Sesión</a></p>
    <p>Tu ID de usuario es: <?= htmlspecialchars($userId) ?></p>

 
    <h2>Bienvenido</h2>
    <p><a href="registro_mascota.php">Registro</a></p>  

    <?php if (empty($registros_mascotas)): ?>
        <p>No hay ningún registro de mascotas.</p>
    <?php else: ?>
        <ul>
        <h2> Mis mascotas </h2>
            <?php foreach ($registros_mascotas as $registro): ?>
                
                <li>
                    <article>
                    <h3>Num. de Serie: <a href="muestra_mascotas.php?id=<?= $registro['id']; ?>"><?= htmlspecialchars($registro['serial_number']); ?></a></h3>
                        <p><p>Nombre: <?= htmlspecialchars($registro['mascot_name']); ?></p></p>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php else: ?>
    <p>Estás desconectado. <a href="index.php">Inicia Sesión</a></p>
    <p>Si no tienes cuenta, <a href="registro_user.php">regístrate aquí</a></p>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>

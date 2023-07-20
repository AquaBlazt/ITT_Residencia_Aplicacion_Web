<?php
require 'includes/init.php';
Auth::requireLogin();
$conn = require 'includes/db.php';


$userId = Auth::getUserId();
$registros_mascotas = ListaMascotas::GetAll($conn, $userId);

?>

<?php require 'includes/header.php'; ?>
<?php if (Auth::isLoggedIn()): ?>
  <p>Estas conectado. <a href="logout.php">Cerrar Sesion</a></p>
  <p>Tu ID de usuario administrador es: <?= htmlspecialchars($userId) ?></p>
  <h2>Administracion</h2>
  <title>Lista de mascotas</title>
  <p><a href="registro_mascota_admin.php">Registro</a></p>  
</head>
<body>
<?php if (empty($registros_mascotas)): ?>
    <p>No hay ningun registro de mascotas.</p>
<?php else: ?>

    <table>
        <thead>
            <th>Lista de las mascotas registradas</th>
        </thead>
        <tbody>
        <?php foreach ($registros_mascotas as $registro): ?>
            <tr>
                <td>
                    <p>Num. de serie: <a href="muestra_mascotas_admin.php?id=<?= $registro['id']; ?>"><?= htmlspecialchars($registro['serial_number']); ?></a></p>         
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  
<?php endif; ?>
<?php else: ?>
 
 <p>Estas desconectado. <a href="index.php">Inicia Sesión</a></p>
 <p>Si no tienes cuenta, <a href ="registro_user.php">registrate aqui</a></p>

<?php endif; ?>
<?php require 'includes/footer.php'; ?>
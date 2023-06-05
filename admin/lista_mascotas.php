<?php
require '\residencia\includes\init.php';
Auth::requireLogin();
$conn = require '\residencia\includes\db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 4, ListaMascotas::getTotal($conn));
$userId = Auth::getUserId();
$registros_mascotas = ListaMascotas::getPage($conn,$userId, $paginator->limit, $paginator->offset);

?>

<?php require '\residencia\includes\header.php'; ?>
<?php if (Auth::isLoggedIn()): ?>
  <p>Estas conectado. <a href="logout.php">Cerrar Sesion</a></p>
  <p>Tu ID de usuario administrador es: <?= htmlspecialchars($userId) ?></p>
  <h2>Administracion</h2>
  <title>Lista de mascotas</title>
  <p><a href="registro_mascota.php">Registro</a></p>  
</head>
<body>
<?php if (empty($registros_mascotas)): ?>
    <p>No hay ningun registro de mascotas.</p>
<?php else: ?>

    <table>
        <thead>
            <th>Lista de las mascotas</th>
        </thead>
        <tbody>
        <?php foreach ($registros_mascotas as $registro): ?>
            <tr>
                <td>
                    <a href="/admin/muestra_mascotas.php?id=<?= $registro['id']; ?>"><?= htmlspecialchars($registro['serial_number']); ?></a>         
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <nav>
        <ul>
            <li>
                <?php if ($paginator->previous): ?>
                    <a href="?page=<?= $paginator->previous; ?>">Atras</a>
                <?php else: ?>
                    Atras
                <?php endif; ?>
            </li>
            <li>
                <?php if ($paginator->next): ?>
                    <a href="?page=<?= $paginator->next; ?>">Siguiente</a>
                <?php else: ?>
                    Siguiente
                <?php endif; ?>
            </li>
        </ul>
    </nav>

<?php endif; ?>
<?php else: ?>
 
 <p>Estas desconectado. <a href="login.php">Inicia Sesión</a></p>
 <p>Si no tienes cuenta, <a href ="registro_user.php">registrate aqui</a></p>

<?php endif; ?>
<?php require '\residencia\includes\footer.php'; ?>
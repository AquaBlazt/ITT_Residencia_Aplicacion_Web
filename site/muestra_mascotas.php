<?php
require '\residencia\includes\database.php';
require '\residencia\includes\registro.php';
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_GET['id'])) {

$registro_mascota = getRegistro($conn , $_GET['id']);

} else 
{
    $registro_mascota = null;
}

?>

<?php require '\residencia\includes\header.php'; ?>
  <title>Muestra de las mascotas registradas</title>
</head>
<body>
<?php if ($registro_mascota === null): ?>
    <p>No hay ningun registro de mascotas.</p>
<?php else: ?>

    <article>
        <h2><?= htmlspecialchars($registro_mascota['serial_number']); ?></h2>
        <p><?= htmlspecialchars($registro_mascota['mascot_name']); ?></p>
        <p><?= htmlspecialchars($registro_mascota['age']); ?></p>
        <p><?= htmlspecialchars($registro_mascota['gender']); ?></p>
        <p><?= htmlspecialchars($registro_mascota['sickness']); ?></p>
        <p><?= htmlspecialchars($registro_mascota['sterilized']); ?></p>
    </article>
    <a href="edicion_mascotas.php?id=<?= $registro_mascota['id']; ?>">Editar</a>
    <a href="delete_mascotas.php?id=<?= $registro_mascota['id']; ?>">Eliminar</a>


<?php endif; ?>
<?php require '\residencia\includes\footer.php'; ?>
<?php
require '\residencia\includes\init.php';
Auth::requireLogin();
$conn = require '\residencia\includes\db.php';



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
  <title>Muestra de las mascotas registradas</title>
</head>
<body>
<?php if ($registro_mascota) : ?>
    <article>
        <h2><?= htmlspecialchars($registro_mascota->serial_number); ?></h2>
        <?php if ($registro_mascota->image_file) : ?>
    <img src="uploads\<?= $registro_mascota->image_file; ?>">
    <?php endif; ?>
        <p><?= htmlspecialchars($registro_mascota->mascot_name); ?></p>
        <p><?= htmlspecialchars($registro_mascota->age); ?></p>
        <p><?= htmlspecialchars($registro_mascota->gender); ?></p>
        <p><?= htmlspecialchars($registro_mascota->sickness); ?></p>
        <p><?= htmlspecialchars($registro_mascota->sterilized); ?></p>
    </article>
    <a href="edicion_mascotas.php?id=<?= $registro_mascota->id; ?>">Editar</a>
    <a href="foto.php?id=<?= $registro_mascota->id; ?>">Foto</a>
    <a href="lista_mascotas.php">Mis mascotas</a>
    
 
<?php else : ?>
        <p>No se encontro ningun registro</p>
<?php endif; ?>

<?php require '\residencia\includes\footer.php'; ?>
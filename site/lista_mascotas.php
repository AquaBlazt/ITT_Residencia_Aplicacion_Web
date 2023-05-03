<?php

require '\residencia\includes\database.php';
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);

$sql = "SELECT *
        FROM registro_mascota
        ORDER BY serial_number;";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $registros_mascotas = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="esp">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/css/style.css" rel="stylesheet" />
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
</body>
</html>
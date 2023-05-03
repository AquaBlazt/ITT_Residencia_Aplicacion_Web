<?php
require '\residencia\includes\database.php';
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $sql = "SELECT *
            FROM registro_mascota
            WHERE id = " . $_GET['id'];

    $results = mysqli_query($conn, $sql);

    if ($results === false) {

        echo mysqli_error($conn);

    } else {

        $registro_mascota = mysqli_fetch_assoc($results);

    }

} else {
    $registro_mascota = null;
}

?>

<!DOCTYPE html>
<html lang="esp">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/css/style.css" rel="stylesheet" />
  <title>Muestra de las mascotas registradas</title>
</head>
<body>
<?php if ($registro_mascota === null): ?>
    <p>No hay ningun registro de mascotas.</p>
<?php else: ?>

    <registro_mascota$registro_mascota>
        <h2><?= htmlspecialchars($registro_mascota['serial_number']); ?></h2>
        <p><?= htmlspecialchars($registro_mascota['mascot_name']); ?></p>
        <p><?= htmlspecialchars($registro_mascota['age']); ?></p>
        <p><?= htmlspecialchars($registro_mascota['gender']); ?></p>
        <p><?= htmlspecialchars($registro_mascota['sickness']); ?></p>
        <p><?= htmlspecialchars($registro_mascota['sterilized']); ?></p>
    </registro_mascota$registro_mascota>

<?php endif; ?>
</body>
</html>
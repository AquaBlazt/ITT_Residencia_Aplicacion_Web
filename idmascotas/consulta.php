<?php
require 'includes/init.php';

$busqueda = null; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $conn = require 'includes/db.php';
  $ListaMascota = new ListaMascotas();
  $search = $_POST['search'];
  $busqueda = $ListaMascota->search($conn, $search);

}



?>
<?php require 'includes/header.php'; ?>
<a href="index.php">Inicio</a>
<p>¡Si encontraste una mascota puedes ayudarnos a localizar a su dueño!</p>
  <p>Solamente debes revisar el collar de la mascota, en este se encuentra un numero
    el cual simplemente debes introducir aqui mismo y te mostrara el numero telefonico de su dueño.</p>
<?php if (empty($busqueda)): ?>
        <p>No hay ningún registro de mascota con ese numero.</p>

</head>
<body>
<form method="post">
    <?php else: ?>
      <p>Foto: <img src="uploads\<?= $busqueda->image_file; ?>"></p>
    <p><p>Nombre de la mascota: <?= htmlspecialchars($busqueda->mascot_name); ?></p></p>
        <p><p>Edad(En años): <?= htmlspecialchars($busqueda->age); ?></p></p>
        <p><p>Genero(Macho->1, Hembra->2): <?= htmlspecialchars($busqueda->gender); ?></p></p>
        <p><p>Descripcion: <?= htmlspecialchars($busqueda->sickness); ?></p></p>
        <p><p>Esterilizado(Si->1, No->2): <?= htmlspecialchars($busqueda->sterilized); ?></p></p>
        <p><p>Num. telefonico para contactar al dueño en caso de extravio: <?= htmlspecialchars($busqueda->phone_number); ?></p></p>

    <?php endif; ?> 
    <form method="post">
<div>
  <label for="search"> Introduzca el numero que se encuentra en el collar de la mascota</label>
  <input type="number" name="search" id="search" 
  />


</div>
<button type="submit">Buscar</button>


    </form>
        
<?php require 'includes/footer.php'; ?>
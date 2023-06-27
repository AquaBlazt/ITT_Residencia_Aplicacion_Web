<?php
require '/residencia/includes/init.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $conn = require '/residencia/includes/db.php';
  $ListaMascota = new ListaMascotas();
  $search = $_POST['search'];
  $busqueda = $ListaMascota->search($conn, $search);
  var_dump($busqueda);



}



?>
<?php require '\residencia\includes\header.php'; ?>
<form method="post">
  <p>¡Si encontraste una mascota puedes ayudarnos a localizar a su dueño!</p>
  <p>Solamente debes revisar el collar de la mascota, en este se encuentra un numero
    el cual simplemente debes introducir aqui mismo y te mostrara el numero telefonico de su dueño.</p>
    <form method="post">
<div>
  <label for="search"> Introduzca el numero que se encuentra en el collar de la mascota</label>
  <input type="number" name="search" id="search" required />


</div>
<button type="submit">Buscar</button>

    </form>
        
<?php require '\residencia\includes\footer.php'; ?>
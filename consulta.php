<?php
require '/residencia/includes/init.php';

$conn = require '\residencia\includes\db.php';




?>
<?php require '\residencia\includes\header.php'; ?>
<form method="post">
  <p>¡Si encontraste una mascota puedes ayudarnos a localizar a su dueño!</p>
  <p>Solamente debes revisar el collar de la mascota, en este se encuentra un numero
    el cual simplemente debes introducir aqui mismo y te mostrara el numero telefonico de su dueño</p>
    
    <div>
    
    <label for="serie">Introduzca el numero del collar</label>
        <input type="number" name="serie" id="serie" required />
          </div>

          
          <button type="submit" class="form-btn">Buscar</button>
          
        </form>
<?php require '\residencia\includes\footer.php'; ?>
<?php
require '\residencia\includes\database.php';
$conn=getDB();
?>
<!DOCTYPE html>
<html lang="esp">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/style.css" rel="stylesheet" />
    <title>Inicio</title>
  </head>
  <body>
    <div class="container">
      <div class="form-container">
        <form action="" method="post">
        <a href="registro.php">Registro</a>
        <a href="menu-admin.php">Menu-admin</a>
          <h1>Inicio de sesion</h1>
          <input
            type="text"
            
            placeholder="Usuario"
            class="field"
            name="email"
            id="email"
          />

          <input
            type="password"
            
            placeholder="Contraseña"
            class="field"
            name="password"
          />

          <button type="submit" class="form-btn" name="log-in">
            Iniciar sesion
          </button>
          
        </form>
      </div>
    </div>
  </body>
</html>

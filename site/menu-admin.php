<?php
require '\residencia\includes\database.php';
?>
<!DOCTYPE html>
<html lang="esp">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/style.css" rel="stylesheet" />
    <title>Menu Admin</title>
  </head>
  <body>
    <div class="container">
      <div class="form-container">
        <form action="">
        <a href="index.php">Inicio</a>
        <a href="registro.php">Registro</a>
          <h1>Bienvenido Admin</h1>
          <button type="submit" class="form-btn">Registrar</button>
          <button type="submit" class="form-btn">Lista de mascotas</button>
          <button type="submit" class="form-btn">Salir</button>
        </form>
      </div>
    </div>
  </body>
</html>

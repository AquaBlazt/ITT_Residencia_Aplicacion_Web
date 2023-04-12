<?php
require '\residencia\includes\database.php';
$sql= "INSERT INTO mascotas (foto,num_serie,nombre,edad,genero,enfermedad,direccion,num_telefonico,
num_telefonico_extra,esterilizado,email,contraseña)
VALUES(?,?,?,?,?,?,?,?,?,?,?,?";

$stmt= mysqli_prepare($conn, $sql);

if($stmt===false)
{
  echo mysqli_error($conn);
}
else
{
  mysqli_stmt_bind_param($stmt, "sss", 
  $_POST['foto'],$_POST['num_serie'],$_POST['nombre'],$_POST['edad'],$_POST['genero'],$_POST['enfermedad'],
  $_POST['direccion'],$_POST['num_telefonico'],$_POST['num_telefonico_extra'],$_POST['esterilizado'],
  $_POST['email'],$_POST['contraseña']);

  if(mysqli_stmt_execute($stmt))
  {
    $id=mysqli_insert_id($conn);
    echo "Se inserto correctamente la informacion con el ID: $id";

  }
  else
  {
    echo mysqli_stmt_error($stmt);
  }
}

var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="esp">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/style.css" rel="stylesheet" />
    <title>Registro</title>
  </head>
  <body>
    <div class="container">
      <div class="form-container">
        <form method="post">
          <h1>Registro</h1>
          <p>Subir foto de la mascota</p>
          <input class="field" type="file" name="foto" id="foto"  />
          <input
            class="field"
            type="number"
            placeholder="Num. serie"
            name="num_serie"
            
          />
          <input
            type="text"
            class="field"
            placeholder="Nombre"
            name="nombre"
            id="nombre"
            
          />
          <input
            type="number"
            class="field"
            placeholder="Edad"
            name="edad"
            id="edad"
            
          />
          <p>Genero</p>
          <select class="field" name="genero" id="genero">
            <option disabled hidden selected></option>
            <option>Macho</option>
            <option>Hembra</option>
          </select>
          <input
            type="text"
            placeholder="Enfermedad visible(descripcion breve)"
            name="enfermedad"
            id="enfermedad"             
            class="field"
          />
          <input
            type="text"
            placeholder="Direccion"
            name="direccion"
            id="direccion"
            class="field"
          />
          <input
            type="number"
            placeholder="Num. Telefonico"
            name="num_telefonico"
            id="num_telefonico"
            class="field"
          />
          <input
            type="number"
            placeholder="Num. Telefonico(2)"
            name="num_telefonico_extra"
            id="num_telefonico_extra"
            class="field"
          />
          <p>Su mascota se encuentra esterilizada?</p>
          <select class="field" name="esterilizado" id="esterilizado">
            <option disabled hidden selected></option>
            <option>Si</option>
            <option>No</option>
          </select>

          <h2>Cuenta del Usuario</h2>
          <input
            type="email"
            class="field"
            placeholder="E-mail"
            name="email"
            id="email"
           
          />

          <input
            type="email"
            class="field"
            placeholder="Confirma E-mail"
            name="email"
          />

          <input
            type="password"
            class="field"
            placeholder="Contraseña"
            name="contraseña"
          />

          <input
            type="password"
            class="field"
            placeholder="Confirma contraseña"
            name="password"
          />
          <button type="submit" class="form-btn">Registrar</button>
          <button type="submit" class="form-btn">Regresar</button>
        </form>
      </div>
    </div>
  </body>
</html>
 <!-- required -->
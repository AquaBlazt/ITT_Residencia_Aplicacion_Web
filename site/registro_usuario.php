<?php
require '\residencia\includes\database.php';
$conn=getDB();

$errors=[];
$name='';
$email='';
$password='';
$password_confirmation='';
$phone_number='';
$phone_number_extra='';
$address='';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$name= $_POST['name'];
$email= $_POST['email'];
$password= $_POST['password'];
$password_confirmation=$_POST['password_confirmation'];
$phone_number= $_POST['phone_number'];
$phone_number_extra= $_POST['phone_number_extra'];
$address= $_POST['address'];


if($name=='')
{
  $errors[]='Se requiere un nombre';
}
if(! filter_var($email, FILTER_VALIDATE_EMAIL))
{
  $errors[]='Se requiere un E-mail valido';
}
if($password == '')
{
  $errors[]='Se requiere una contraseña';
}
if($password !== $password_confirmation)
{
  $errors[]='Las contraseñas no coinciden';
}
if($address=='')
{
  $errors[]='Se requiere una direccion';
}
if($phone_number=='')
{
  $errors[]='Se requiere al menos un numero telefonico';
}
if($phone_number==$phone_number_extra)
{
$errors[]='No puedes introducir los mismos numeros telefonicos';
}
if($address=='')
{
  $errors[]='Se requiere una direccion';
}



$password_hash= password_hash($password, PASSWORD_DEFAULT);

if(empty($errors))
{
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);
  $sql= "INSERT INTO registro_usuario (name,email,password_hash,address,phone_number,phone_number_extra)
  VALUES (?, ?, ?, ?, ?, ?)";
   
  $stmt= mysqli_prepare($conn, $sql);
  
  if($stmt===false)
  {
    echo mysqli_error($conn);
  }
  else
  {

    if($phone_number_extra=='')
    {
      $phone_number_extra = null;
    }

    mysqli_stmt_bind_param($stmt, "ssssss",$name, $email, $password_hash, $address, $phone_number, $phone_number_extra);  
if(mysqli_stmt_execute($stmt))
{
  $id = mysqli_insert_id($conn);
  echo "Se inserto la informacion con el ID: $id";
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
{
  $protocol = 'https';
}
else
{
  $protocol = 'http';
}
  header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/site/inicio.php?id=$id");
  exit;
}
else
{
  if ($conn->errno === 1062) {
    $errors[]="Ya existe un registro con el e-mail introducido";
} else {
    die($conn->error . " " . $conn->errno);
}
  
}
  }
 }
}
?>
<!DOCTYPE html>
<html lang="esp">
  <head>
    <meta charset="UTF-8" />
    <link href="/css/style.css" rel="stylesheet" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro de Usuario</title>
    <a href="inicio.php">Inicio</a>
    <?php if (! empty($errors)): ?>
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?= $error ?></li>
        <?php endforeach; ?>
      </ul>
 <?php endif; ?>
 
  </head>
  <body>
    <h1>Registro de Usuario</h1>
    <form action="" method="post" novalidate>
      <div>
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" placeholder="Nombre" value="<?= htmlspecialchars($name); ?>"  />
      </div>

      <div>
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="E-mail" value="<?= htmlspecialchars($email); ?>"    />
      </div>
      <div>
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Contraseña" name="password" value="<?= htmlspecialchars($password); ?>"/>
      </div>
      <div>
        <label for="password_confirmation">Confirme la Contraseña</label>
        <input
          type="password"
          id="password_confirmation"
          name="password_confirmation"
          placeholder="Confirmar contraseña"
          value="<?= htmlspecialchars($password_confirmation); ?>"
        />
      </div>


      <div>
<label for="address">Direccion</label>
          <input
            type="text"
            placeholder="Direccion"
            name="address"
            id="address"
            class="field"
            value="<?= htmlspecialchars($address); ?>"
          />
</div>


      <div>
<label for="phone_number">Num. Telefonico</label>
          <input
            type="number"
            placeholder="Num. Telefonico"
            name="phone_number"
            id="phone_number"
            class="field"
            value="<?= htmlspecialchars($phone_number); ?>"
          />
</div>

<div>
<label for="phone_number_extra">2do. Num. Telefonico</label>
          <input
            type="number"
            placeholder="Num. Telefonico"
            name="phone_number_extra"
            id="phone_number_extra"
            class="field"
            value="<?= htmlspecialchars($phone_number_extra); ?>"
          />
</div>

      <button>Registrar</button>
    </form>
  </body>
</html>

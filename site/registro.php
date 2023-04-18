<?php
require '\residencia\includes\database.php';
$errors=[];
$pic='';
$serial_number='';
$mascot_name='';
$age='';
$gender='';
$sickness='';
$address='';
$phone_number='';
$phone_number_extra='';
$sterilized='';
$name='';
$email='';
$password='';
$password_confirmation='';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$pic = $_POST['pic'];
$serial_number= $_POST['serial_number'];
$mascot_name= $_POST['mascot_name'];
$age= $_POST['age'];
$gender= filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_INT);
$sickness= $_POST['sickness'];
$address= $_POST['address'];
$phone_number= $_POST['phone_number'];
$phone_number_extra= $_POST['phone_number_extra'];
$sterilized= filter_input(INPUT_POST, 'sterilized', FILTER_VALIDATE_INT);
$name= $_POST['name'];
$email= $_POST['email'];
$password= $_POST['password'];
$password_confirmation=$_POST['password_confirmation'];

if($pic=='')
{
  $errors[]='Se requiere una foto de la mascota';
}
if($serial_number=='')
{
  $errors[]='Se requiere un numero de serie';
}
if($mascot_name=='')
{
  $errors[]='Se requiere el nombre de la mascota';
}
if($age=='')
{
  $errors[]='Se requiere la edad de la mascota';
}
if($gender=='')
{
  $errors[]='Se requiere el genero de la mascota';
}
if($address=='')
{
  $errors[]='Se requiere una direccion del dueño';
}
if($phone_number=='')
{
  $errors[]='Se requiere al menos un numero telefonico';
}
if($sterilized=='')
{
  $errors[]='Se requiere saber si la mascota esta esterilizada';
}
if($name=='')
{
  $errors[]='Se requiere el nombre del dueño';
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

$password_hash= password_hash($password, PASSWORD_DEFAULT);

if(empty($errors))
{
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);
  $sql= "INSERT INTO registro (pic,serial_number,mascot_name,age,gender,sickness,
  address,phone_number,phone_number_extra,sterilized,name,email,password_hash)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      
  $stmt= mysqli_prepare($conn, $sql);
  
  if($stmt===false)
  {
    echo mysqli_error($conn);
  }
  else
  {

    if($sickness=='')
    {
      $sickness = null;
    }

    if($phone_number_extra=='')
    {
      $phone_number_extra = null;
    }


    mysqli_stmt_bind_param($stmt, "ssssissssisss", $pic, $serial_number, $mascot_name,
    $age, $gender, $sickness, $address, $phone_number,
    $phone_number_extra, $sterilized, $name, $email, $password_hash);  
if(mysqli_stmt_execute($stmt))
{
  $id = mysqli_insert_id($conn);
  echo "Se inserto la informacion con el ID: $id";
}
else
{
  if ($conn->errno === 1062) {
    $errors[]="Ya existe un registro con el e-mail, num. telefonico o num. de serie introducido";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/style.css" rel="stylesheet" />
    <title>Registro</title>
    <?php if (! empty($errors)): ?>
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?= $error ?></li>
        <?php endforeach; ?>
      </ul>
 <?php endif; ?>
  </head>
  <body>
    <div class="container">
      <div class="form-container">
        <form method="post">
        <a href="index.php">Inicio</a>
          <h2>Registro de la mascota</h2>
<div>

          <label for="pic">Foto</label>
          <input class="field" type="file" name="pic" id="pic"/>
</div>

<div>
<label for="serial_number">Num. de serie</label>
          <input
            class="field"
            type="number"
            placeholder="Num. serie"
            name="serial_number"  
            id="serial_number" 
            value="<?= htmlspecialchars($serial_number); ?>"
          />
</div>

<div>
<label for="mascot_name">Nombre</label>
          <input
            type="text"
            class="field"
            placeholder="Nombre"
            name="mascot_name"
            id="mascot_name"
            value="<?= htmlspecialchars($mascot_name); ?>"
          />
</div>

<div>
<label for="age">Edad</label>
          <input
            type="number"
            class="field"
            placeholder="Edad"
            name="age"
            id="age"   
            value="<?= htmlspecialchars($age); ?>"        
          />
</div>

<div>
<label for="gender">Genero</label>
          <select class="field" name="gender" id="gender">
            <option value="1">Macho</option>
            <option value="2">Hembra</option>
          </select>
</div>

<div>
<label for="sickness">Enfermedad Visible</label>
        <textarea name="sickness" id="sickness" cols="40" rows="12" placeholder="Descripcion"><?= htmlspecialchars($sickness); ?></textarea>
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

<div>
<label for="sterilized">Su mascota se encuentra esterilizada?</label>
          <select class="field" name="sterilized" id="sterilized">
            <option value="1">Si</option>
            <option value="2">No</option>
          </select>
</div>


          <h2>Cuenta del Usuario</h2>

<div>
  <label for="name">Nombre</label>
          <input
            type="text"
            class="field"
            placeholder="Nombre"
            name="name"
            id="name"
            value="<?= htmlspecialchars($name); ?>"          
          />
</div>

<div>
<label for="email">E-mail</label>
          <input
            type="email"
            class="field"
            placeholder="E-mail"
            name="email"
            id="email"   
            value="<?= htmlspecialchars($email); ?>"       
          />
</div>

<div>
<label for="password">Contraseña</label>
          <input
            type="password"
            class="field"
            placeholder="Contraseña"
            name="password"
            id="password"
            value="<?= htmlspecialchars($password); ?>"
          />
</div>

<div>
<label for="password_confirmation">Confirmar contraseña</label>
          <input
            type="password"
            class="field"
            placeholder="Confirma contraseña"
            name="password_confirmation"
            id="password_confirmation"
            value="<?= htmlspecialchars($password_confirmation); ?>"
            
          />
</div>


          <button type="submit" class="form-btn">Regresar</button>
          <button type="submit" class="form-btn">Registrar</button>
          
        </form>
      </div>
    </div>
  </body>
</html>
 <!-- required -->
<?php
require '\residencia\includes\database.php';
$errors=[];
$pic='';
$serial_number='';
$mascot_name='';
$age='';
$gender='';
$sickness='';
$sterilized='';


if($_SERVER["REQUEST_METHOD"]=="POST")
{
$pic = $_POST['pic'];
$serial_number= $_POST['serial_number'];
$mascot_name= $_POST['mascot_name'];
$age= $_POST['age'];
$gender= filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_INT);
$sickness= $_POST['sickness'];
$sterilized= filter_input(INPUT_POST, 'sterilized', FILTER_VALIDATE_INT);


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
if($sterilized=='')
{
  $errors[]='Se requiere saber si la mascota esta esterilizada';
}


if(empty($errors))
{
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);
  $sql= "INSERT INTO registro_mascota (pic,serial_number,mascot_name,age,gender,sickness,sterilized)
  VALUES (?, ?, ?, ?, ?, ?, ?)";

      
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

    mysqli_stmt_bind_param($stmt, "iisissi", $pic, $serial_number, $mascot_name,
    $age, $gender, $sickness, $sterilized);  
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
  header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/site/menu.php?id=$id");
  exit;
}
else
{
  if ($conn->errno === 1062) {
    $errors[]="Ya existe un registro con el num. de serie introducido";
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
    <title>Registro de la Mascota</title>
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
          <h2>Registro de la Mascota</h2>
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
            <option value="">--Elige una opcion--</option>
            <option value="1">Macho</option>
            <option value="2">Hembra</option>
          </select>
</div>

<div>
<label for="sickness">Enfermedad</label>
        <textarea name="sickness" id="sickness" cols="40" rows="12" placeholder="Describala"><?= htmlspecialchars($sickness); ?></textarea>
</div>

<div>
<label for="sterilized">Su mascota se encuentra esterilizada?</label>
          <select class="field" name="sterilized" id="sterilized">
          <option value="">--Elige una opcion--</option>
            <option value="1">Si</option>
            <option value="2">No</option>
          </select>
</div>
          
          <button type="submit" class="form-btn">Registrar</button>
          
        </form>
  <form>
        </form>
      </div>
    </div>
  </body>
</html>
 <!-- required -->
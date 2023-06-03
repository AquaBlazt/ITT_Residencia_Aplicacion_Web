<?php
/**
 * La clase ListaMascotas incluye todo lo relacionado a las mascotas registradas las
 * cuales son mostradas en forma de lista
 * 
 * @function getAll Muestra todos los registros dentro de la base de datos
 * @function getByID Muestra la informacion individual de los registros en la base de datos
 * @function update Permite editar y actualizar un registro previamente ingresado
 * @function delete Permite eliminar informacion registrada previamente
 */

class ListaMascotas
{
public $usuario_id;
public $id;
public $serial_number;
public $mascot_name;
public $age;
public $gender;
public $sickness;
public $sterilized;
public $errors= [];


  public static function getAll($conn)
  {
    $sql = "SELECT *
    FROM registro_mascota
    ORDER BY serial_number;";

$results = $conn->query($sql);
return $results->fetchAll(PDO::FETCH_ASSOC);

  }

  public static function getTotal($conn)
  {
      return $conn->query('SELECT COUNT(*) FROM registro_mascota')->fetchColumn();
  }

  public static function getPage($conn, $limit, $offset)
    {
        $sql = "SELECT *
                FROM registro_mascota
                ORDER BY serial_number
                LIMIT :limit
                OFFSET :offset";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public static function getByID($conn, $id, $columns = '*')
{
    $sql = "SELECT $columns
            FROM registro_mascota
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'ListaMascotas');

    if ($stmt->execute()) {

        return $stmt->fetch();
    }
}


public function update($conn)
{
  if ($this->validate())
  {

  $sql= "UPDATE registro_mascota 
           SET serial_number= :serial_number,
               mascot_name= :mascot_name,
               age= :age,
               gender= :gender,
               sickness= :sickness,
               sterilized= :sterilized
          WHERE id= :id";
               

          $stmt = $conn->prepare($sql);

          $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
          $stmt->bindValue(':serial_number', $this->serial_number, PDO::PARAM_INT);
          $stmt->bindValue(':mascot_name', $this->mascot_name, PDO::PARAM_STR);
          $stmt->bindValue(':age', $this->age, PDO::PARAM_INT);
          $stmt->bindValue(':gender', $this->gender, PDO::PARAM_INT);
          $stmt->bindValue(':sickness', $this->sickness, PDO::PARAM_STR);
          $stmt->bindValue(':sterilized', $this->sterilized, PDO::PARAM_INT);

          if ($this->sickness == '') 
          {
            $stmt->bindValue(':sickness', null, PDO::PARAM_NULL);
          } 
          else 
          {
            $stmt->bindValue(':sickness', $this->sickness, PDO::PARAM_STR);
          }     

         

        return $stmt->execute();
  }
  else
  {
    return false;
  }
}

protected function validate()
{
  if ($this->usuario_id=='')
  {
    $this->errors[]='Se requiere que introduzcas tu ID';
  }
if($this->serial_number=='')
{
  $this->errors[]='Se requiere un numero de serie';
}
if($this->mascot_name=='')
{
  $this->errors[]='Se requiere el nombre de la mascota';
}
if($this->age=='')
{
  $this->errors[]='Se requiere la edad de la mascota';
}
if($this->gender=='')
{
  $this->errors[]='Se requiere el genero de la mascota';
}
if($this->sterilized=='')
{
  $this->errors[]='Se requiere saber si la mascota esta esterilizada';
}

if (empty($this->id) && $this->serialNumberExists($this->serial_number))
{
  $this->errors[]='Ya existe un registro con ese Num. de Serie';
}

if (empty($this->usuario_id) === $this->userIdDosentExist($this->usuario_id))
{
$this->errors[] = 'No existe un usuario con ese ID';
}



return empty($this->errors);
}

protected function userIdDosentExist($usuario_id)
{
  
  $sql = "SELECT *
  FROM registro_mascota
  WHERE usuario_id = :usuario_id";


$db = Database::getConn();
$stmt = $db->prepare($sql);
$stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);


$stmt->execute();
return $stmt->fetch() !== false;

}


protected function serialNumberExists($serial_number)
{
 
  $sql = "SELECT *
  FROM registro_mascota
  WHERE serial_number = :serial_number";

$db = Database::getConn();
$stmt = $db->prepare($sql);
$stmt->bindValue(':serial_number', $serial_number, PDO::PARAM_INT);


$stmt->execute();
return $stmt->fetch() !== false;

}



public function delete($conn)
{
  $sql= "DELETE FROM registro_mascota 
         WHERE id= :id";

 $stmt = $conn->prepare($sql);

 $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
    

return $stmt->execute();
}


public function create($conn)
{
  if ($this->validate())
  {

  $sql= "INSERT INTO registro_mascota (serial_number, mascot_name, age, gender, sickness, sterilized, usuario_id)
           VALUES (:serial_number,
                   :mascot_name,
                   :age,
                   :gender,
                   :sickness,
                   :sterilized,
                   :usuario_id)";
                   
          

          $stmt = $conn->prepare($sql);
          
          $stmt->bindValue(':serial_number', $this->serial_number, PDO::PARAM_INT);
          $stmt->bindValue(':mascot_name', $this->mascot_name, PDO::PARAM_STR);
          $stmt->bindValue(':age', $this->age, PDO::PARAM_INT);
          $stmt->bindValue(':gender', $this->gender, PDO::PARAM_INT);
          $stmt->bindValue(':sickness', $this->sickness, PDO::PARAM_STR);
          $stmt->bindValue(':sterilized', $this->sterilized, PDO::PARAM_INT);
          $stmt->bindValue(':usuario_id', $this->usuario_id, PDO::PARAM_INT);

          if ($this->sickness == '') 
          {
            $stmt->bindValue(':sickness', null, PDO::PARAM_NULL);
          } 
          else 
          {
            $stmt->bindValue(':sickness', $this->sickness, PDO::PARAM_STR);
          }     

          
          if ($stmt->execute()) 
          {
            $this->id = $conn->lastInsertId();
            return true;
          }
  }
  else
  {
    return false;
  }
}
}

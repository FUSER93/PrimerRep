<?php
require_once('autoload.php');

  class Repositorio{

    private $db;
    private $dsn;
    private $user;
    private $pass;

    public function __construct(){
      //conexion al db
      $this->dsn="mysql:host=localhost;dbname=ecommerce;charset=utf8mb4;port:3306";
      $this->user="root";
      $this->pass="root";

      try {
      	$this->db=new PDO ($this->dsn,$this->user,$this->pass);
      	$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      }
      catch (PDOException $e){
      	echo 'error'.$e->getMessage();
      	exit;
      }
    }

    public function traerTodos(){

      $sql="select * from usuarios";
      $stmt=$this->db->prepare($sql);
      $stmt->execute();
      $todosLosUsuariosArray=$stmt->fetchAll();

      return $todosLosUsuariosArray;
    }

    public function existeEmail($email){

        $sql="select * from usuarios where email = '".$email ."'";
        $stmt=$this->db->prepare($sql);

        $stmt->execute();
        return $stmt->fetch();
      }

    public function grabarUsuario($datos){

      $nombre = trim($datos['nombre']);
      $apellido = trim($datos['apellido']);
      $profesion = trim($datos['profesion']);
      $email = trim($datos['email']);
      $fecha = $datos['fecha'];
      $pass2 = password_hash($_POST['pass2'], PASSWORD_DEFAULT);
      $pais = $datos['pais'];
      $provincia = $datos['provincia'];
      $ciudad = $datos['ciudad'];
      $genero= $datos['genero'];

      $sql="insert into usuarios values(default, '" .$email ."', '" .$pass2
      ."', now(), '" .$nombre ."', '"  .$apellido ."', '" .$fecha ."', '" .$profesion
      ."', '" .$genero ."', '" .$pais ."', '" .$provincia ."', '" .$ciudad ."')";

      $grabar = $this->db->prepare($sql);
      $grabar->execute();

        if($_FILES['avatar']['error'] === UPLOAD_ERR_OK){
          $nombreImg=$_FILES['avatar']['name'];
          $extension=pathinfo($nombreImg, PATHINFO_EXTENSION);
        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
          $imagen=$_FILES['avatar']['tmp_name'];
          $ubicacion=dirname(__FILE__);
          $ubicacion=$ubicacion . '/avatar/';
          move_uploaded_file($imagen, $ubicacion .$datos['nombre'] .".".$extension);
        }
      }
    }

}


 ?>

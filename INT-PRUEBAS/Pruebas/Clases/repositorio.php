<?php


  class Repositorio{

    private $db;
    private $dsn;
    private $user;
    private $pass;

    public function __construct(){
      //conexion al db
      $this->dsn="mysql:host=localhost;dbname=ecommerce;charset=utf8mb4;port:3306";
      $this->user="root";
      $this->pass="";

      try {
      	$db=new PDO ($this->dsn,$this->user,$this->pass);
      	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      }
      catch (Exception $e){
      	echo "Hubo un error";
      	exit;
      }
    }

    public function traerTodos(){

      $sql = 'SELECT * from usuarios';
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      $todosLosUsuariosArray = $stmt->fetchAll();

      return $todosLosUsuariosArray;
    }

    public function existeEmail($email){

        $sql="select email from usuarios where email = '".$email ."'";
        $stmt=$this->db->prepare($sql);
        $stmt->execute();
        $emailsArray= $stmt->fetchAll();

        foreach ($emailsArray as $email) {
          $existe = $email['email'];
        }
        if($existe){
          return true;
        }
      }

    public function grabarUsuario($datos, $repo){
      if (Validador::validarDatos ($datos, $repo) == false){

      $nombre = trim($datos['nombre']);
      $apellido = trim($datos['apellido']);
      $profesion = trim($datos['profesion']);
      $email = trim($datos['email']);
      $fecha = $datos['dia'] ."-" .$datos['mes'] ."-" .$datos['anio'];
      $pass2 = $datos['pass2'];
      $pais = $datos['pais'];
      $provincia = $datos['provincia'];
      $ciudad = $datos['ciudad'];
      $genero= $datos['genero'];

      $sql="insert into usuarios values(default, " .$email .', ' .$pass2
      .', now(), ' .$nombre .', '  .$apellido .', ' .$fecha .', ' .$profesion
      .', ' .$genero .', ' .$pais .', ' .$provincia .', ' .$ciudad .')';

      $grabar = $repo->prepare($sql);
      $grabar->execute();
      }
        if($_FILES['avatar']['error'] === UPLOAD_ERR_OK){
          $nombreImg=$_FILES['avatar']['name'];
          $extension=pathinfo($nombreImg, PATHINFO_EXTENSION);
        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
          $imagen=$_FILES['avatar']['tmp_name'];
          $ubicacion=dirname(__FILE__);
          $ubicacion=$ubicacion . '/avatar/';
          move_uploaded_file($imagen, $ubicacion .$datos['nombre'] .".".$extension);
        }}

    }

}


 ?>

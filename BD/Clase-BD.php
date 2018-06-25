<?php
class CrearBD {
    private $db;
    private $dsn;
    private $user;
    private $pass;

    public function __construct(){
  $this->dsn="mysql:host=localhost;dbname=mysql;port:3306";
  $this->user="root";
  $this->pass="";

  try {
   $this->db=new PDO ($this->dsn,$this->user,$this->pass);
   $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }
  catch (PDOException $e){
   echo 'error '.$e->getMessage();
   exit;
  }
}

  public function nuevaBD(){

   $crear_db = $this->db->prepare('CREATE DATABASE IF NOT EXISTS ecommerce6 COLLATE utf8_spanish_ci');
   $crear_db->execute();

   if($crear_db){
     $use_db = $this->db->prepare('USE ecommerce6');
     $use_db->execute();
   }
   if($use_db){
     $sql_usuarios ='CREATE TABLE IF NOT EXISTS
     usuarios (id int(11) NOT NULL AUTO_INCREMENT,
     email varchar(50) COLLATE utf8_spanish_ci NOT NULL,
     password varchar(100) COLLATE utf8_spanish_ci NOT NULL,
     creado date COLLATE utf8_spanish_ci NOT NULL,
     nombre varchar(45) COLLATE utf8_spanish_ci NOT NULL,
     apellido varchar(45) COLLATE utf8_spanish_ci NOT NULL,
     fech_nacimiento date NOT NULL,
     profesion varchar(45) NOT NULL,
     genero varchar(30),
     pais varchar(50) NOT NULL,
     provincia varchar(50) NOT NULL,
     ciudad varchar(50) NOT NULL,
     PRIMARY KEY (id))';

      $crear_tb_usuarios = $this->db->prepare($sql_usuarios);
      $crear_tb_usuarios->execute();

      $sql_servicios ='CREATE TABLE IF NOT EXISTS
      servicios (id int(11) NOT NULL AUTO_INCREMENT,
      rubro varchar(45) COLLATE utf8_spanish_ci NOT NULL,
      id_usuario int(11) COLLATE utf8_spanish_ci NOT NULL,
      descripcion varchar(45) COLLATE utf8_spanish_ci NOT NULL,
      monto int(11) COLLATE utf8_spanish_ci NOT NULL,
      fecha_inicio date COLLATE utf8_spanish_ci NOT NULL,
      fecha_fin date NOT NULL,
      PRIMARY KEY (id),
      FOREIGN KEY (id_usuario) REFERENCES usuarios(id))';

      $crear_tb_servicios = $this->db->prepare($sql_servicios);
      $crear_tb_servicios->execute();

      $sql_contrataciones ='CREATE TABLE IF NOT EXISTS
      contrataciones (id int(11) NOT NULL AUTO_INCREMENT,
      id_usuario_contratante int(11) COLLATE utf8_spanish_ci NOT NULL,
      id_servicio_contratado int(11) COLLATE utf8_spanish_ci NOT NULL,
      PRIMARY KEY (id),
      FOREIGN KEY (id_usuario_contratante) REFERENCES usuarios(id),
      FOREIGN KEY (id_servicio_contratado) REFERENCES servicios(id))';

      $crear_tb_contrataciones = $this->db->prepare($sql_contrataciones);
      $crear_tb_contrataciones->execute();

     }
   }
 }

 ?>

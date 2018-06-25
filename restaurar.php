<?php
class Create_database {
    protected $pdo;

    public function __construct() {
      $this->pdo = new PDO("mysql:host=localhost;", "root", "");
 }
    public function my_db(){
      $sql='CREATE DATABASE IF NOT EXISTS ecommerce2 COLLATE utf8_spanish_ci';
      $crear_db = $this->pdo->prepare($sql);
      $crear_db->execute();

      if($crear_db){
        $use_db = $this->pdo->prepare('USE ecommerce2');
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
        genero varchar(30) NOT NULL,
        pais varchar(50) NOT NULL,
        provincia varchar(50) NOT NULL,
        ciudad varchar(50) NOT NULL,
        PRIMARY KEY (id))';

         $crear_tb_usuarios = $this->pdo->prepare($sql_usuarios);
         $crear_tb_usuarios->execute();

         $sql_contrataciones ='CREATE TABLE IF NOT EXISTS
         contrataciones (id int(11) NOT NULL AUTO_INCREMENT,
         id_usuario_contratante int(11) COLLATE utf8_spanish_ci NOT NULL,
         id_servicio_contratado int(11) COLLATE utf8_spanish_ci NOT NULL,
         PRIMARY KEY (id))';

         $crear_tb_contrataciones = $this->pdo->prepare($sql_contrataciones);
         $crear_tb_contrataciones->execute();

         $sql_servicios ='CREATE TABLE IF NOT EXISTS
         servicios (id int(11) NOT NULL AUTO_INCREMENT,
         rubro varchar(45) COLLATE utf8_spanish_ci NOT NULL,
         id_usuario int(11) COLLATE utf8_spanish_ci NOT NULL,
         descripcion varchar(45) COLLATE utf8_spanish_ci NOT NULL,
         monto int(11) COLLATE utf8_spanish_ci NOT NULL,
         fecha_inicio date COLLATE utf8_spanish_ci NOT NULL,
         fecha_fin date NOT NULL,
         PRIMARY KEY (id))';

          $crear_tb_servicios = $this->pdo->prepare($sql_servicios);
          $crear_tb_servicios->execute();
       }
     }
}

if(isset($_POST['restaurar'])) {
  $db = new Create_database();
  $db->my_db();

}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="restaurar.php" method="post">
    <button type="submit" name="button">Generar BD</button>
    </form>

  </body>
</html>

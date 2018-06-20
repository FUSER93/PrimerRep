<?php
require_once('autoload.php');
  class Usuario {
    private $nombre;
    private $apellido;
    private $fecha;
    private $profesion;
    private $email;
    private $pass;
    private $genero;
    private $pais;
    private $provincia;
    private $ciudad;

//sacar direcciones y agregar apellido

    public function __construct ($nombreUser, $apellidoUser, $fechaNac,
    $profesionUser, $emailUser, $passUser, $generoUser, $paisUser,
    $provinciaUser, $ciudadUser) {

      $this ->nombre = $nombreUser;
      $this ->apellido = $apellidoUser;
      $this ->fecha = $fechaNac;
      $this ->profesion = $profesionUser;
      $this ->email = $emailUser;
      $this ->pass = $passUser;
      $this ->genero = $generoUser;
      $this ->pais = $paisUser;
      $this ->provincia = $provinciaUser;
      $this ->ciudad = $ciudadUser;
      $this ->direccion = $direccionUser;
      $this ->altura = $alturaUser;
    }

    public function getNombre(){
      return $this ->nombre;
    }
    public function getEmail(){
      return $this ->email;
    }
    public function setNombre($nombre){
      $this ->nombre=$nombre;
    }
    public function setEmail($email){
      $this->email=$email;
    }
    public function setPass($pass){
      $this ->pass=$pass;
    }
}

 ?>

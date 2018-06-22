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
    }

    public function getNombre(){
      return $this ->nombre;
    }
    public function getApellido(){
      return $this ->apellido;
    }
    public function getFecha(){
      return $this ->fecha;
    }
    public function getEmail(){
      return $this ->email;
    }
    public function getPass(){
      return $this ->pass;
    }
    public function getGenero(){
      return $this ->genero;
    }
    public function getPais(){
      return $this ->pais;
    }
    public function getProvincia(){
      return $this ->provincia;
    }
    public function getCiudad(){
      return $this ->ciudad;
    }

    public function setNombre($nombre){
      $this ->nombre=$nombre;
    }
    public function setApellido($apellido){
      $this ->apellido=$apellido;
    }
    public function setEmail($email){
      $this->email=$email;
    }
    public function setPass($pass){
      $this ->pass=$pass;
    }
    public function setFecha($fecha){
      $this ->fecha=$fecha;
    }
    public function setGenero($genero){
      $this ->genero=$genero;
    }
    public function setCiudad($ciudad){
      $this->ciudad=$ciudad;
    }
    public function setProvincia($provincia){
      $this ->provincia=$provincia;
    }
    public function setPais($pais){
      $this ->pais=$pais;
    }

}

 ?>

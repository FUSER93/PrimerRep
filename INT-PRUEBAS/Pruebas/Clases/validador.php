<?php
require_once('autoload.php');

 abstract class Validador{

   public function passwordVacio() {
     if ($_POST ['pass'] == '' || $_POST ['pass2'] == '') {
       return true;
     }
     }

   public function passwordInvalido (){
     if ($_POST ['pass2'] !== $_POST ['pass']){
       return true;
     }
   }
   public function estaLogeado(){
     return isset($_SESSION['id']);
  }

   public function validarLoginUsuario($datos, $repo){

     $email = trim($datos['email']);
     $pass = trim($datos['pass']);
     $errores = [];

       if ($email == '' || $pass == '') {
             $errores['email'] = 'Por favor, complete los campos';
      }else{
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             $errores['email'] = 'Complete su email con un formato válido';
         }else{
           $usuario = $repo->existeEmail($email);
           if (!$usuario ) {
             $errores['email'] = 'Credenciales invalidas';
           }elseif(!password_verify($pass, $usuario['password'])){
             $errores['pass'] = "Credenciales invalidas";
           }
         }
       }
       return $errores;
     }

   public function validarDatos($datos, $repo){
     if (!isset($datos['terminos'])) {
       $errores['terminos'] = "¡Debes aceptar los Términos y Condiciones!";}

       if (trim($datos['nombre']) == ''){
         $errores['nombre'] = "¡Decinos cúal es tu nombre!";
       }elseif (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $datos['nombre'])) {
         $errores['nombre'] = "¡El nombre tiene un formato incorrecto!";
       }

      if (trim($datos['apellido']) == ''){
        $errores['apellido'] = "¡Decinos cúal es tu apellido!";
      }elseif (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $datos['apellido'])){
        $errores['apellido'] = "¡El apellido tiene un formato incorrecto!";
      }


       if (trim($datos['profesion']) == ''){
         $errores['profesion'] = "¡Decinos de qué trabajas!";
       }elseif (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $datos['apellido'])){
         $errores['apellido'] = "¡La profesion tiene un formato incorrecto!";
       }

       if (strtolower(trim($_POST['email'])) == ''){
         $errores['email'] = "¡Decinos cuál es tu email!";}
         elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
             $errores['email'] = 'Tu mail no tiene un formato válido';}
       elseif ($repo->existeEmail($datos['email'])) {
         $errores['email'] = '¡El mail ya existe!';}

       if(self::passwordVacio() == true){
         $errores['pass'] = "¡Ingresa una contraseña valida!";}
       if(self::passwordInvalido() == true){
         $errores['pass2'] = "¡Las contraseñas no coinciden!";}

       if (!$datos['fecha']){
         $errores['fecha'] = "¡Decinos cuándo es tu cumpleaños!";}

       if ($datos['pais'] == 'Seleccione un pais'){
         $errores['pais'] = "¡Decinos de qué pais sos!";}

       if ($datos['provincia'] == 'Seleccione una provincia'){
         $errores['provincia'] = "¡Decinos de qué provincia sos!";}

       if ($datos['ciudad'] == 'Seleccione una Ciudad'){
         $errores['ciudad'] = "¡Decinos de qué Ciudad sos!";}


         if($_FILES['avatar']['error'] === UPLOAD_ERR_OK){
           $nombreImg=$_FILES['avatar']['name'];
           $extension=pathinfo($nombreImg, PATHINFO_EXTENSION);
           $archivoFisico = $_FILES['avatar']['tmp_name'];
         if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
           $imagen=$_FILES['avatar']['tmp_name'];
           $ubicacion=dirname(__FILE__);
           $ubicacion= $ubicacion .'/avatar/' .$_POST['email'] .'.' .$extension;
           move_uploaded_file($imagen, $ubicacion);
         } else {
           $errores['avatar'] = 'El formato tiene que ser JPG, JPEG, PNG o GIF';
          }
         }
         return $errores;
        }

     }

 ?>

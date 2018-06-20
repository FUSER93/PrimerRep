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

   public function validarLoginUsuario($datos, $repo){
     $email = trim($datos['email']);
     $pass = trim($datos['pass']);
     $errores = [];
     if ($email == '' || $pass == '') {
           $errores['email'] = 'Por favor, complete los campos';
       }
       elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $errores['email'] = 'Complete su email con un formato válido';
       }elseif ($repo->existeMail($email) == false) {
         $errores['email'] = 'Credenciales invalidas';
       }
       return $errores;
     }

   public function validarDatos($datos, $repo){

       if (trim($datos['nombre']) == ''){
         $errores['nombre'] = "¡Decinos cúal es tu nombre!";}

      if (trim($datos['apellido']) == ''){
        $errores['apellido'] = "¡Decinos cúal es tu apellido!";}

       if (trim($datos['profesion']) == ''){
         $errores['profesion'] = "¡Decinos de qué trabajas!";}

       if (trim($datos['email']) == ''){
         $errores['email'] = "¡Decinos cuál es tu email!";}
         elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
             $errores['email'] = 'Tu mail no tiene un formato válido';}
       if ($repo->existeEmail($datos['email'])) {
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


       if($_FILES['avatar'] ['name'] !== '') {
         $nombreImg = $_FILES['avatar']['name'];
         $extension=pathinfo($nombreImg, PATHINFO_EXTENSION);
           if($_FILES['avatar']['error'] !== UPLOAD_ERR_OK){
             $errores['avatar'] = "La imagen no se pudo cargar";
           } elseif (!($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png')){
             $errores['avatar'] = "La imagen no tiene un formato correcto";
           }
       }
       return $errores;
     }

   }
 ?>

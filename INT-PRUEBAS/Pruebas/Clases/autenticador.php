<?php
  require_once('autoload.php');

  class Autenticador{

    public function estaLogeado(){
      return isset($_SESSION['id']);
    }

      public function loguearUsuario($usuario){
        $_SESSION['id'] = $usuario['email'];
      }

      public function nombreUsuario($mail, $repo){
        $usuarios = $repo->traerTodos();
        foreach ($usuarios as $usuario) {
          if ($mail == $usuario['email']) {
          return $usuario['nombre'];
          $nombreUser =$usuario['nombre'];
          }
        }
        return $nombreUser;
      }
  }

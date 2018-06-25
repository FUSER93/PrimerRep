<?php
require_once('Clase-bd.php');
if(isset($_POST['restaurar'])){
  $nueva = new CrearBD();
  $nueva->nuevaBD();
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
    <button type="submit" name="restaurar">Generar BD</button>
    </form>

  </body>
</html>

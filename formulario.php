<?php
require_once('Clases/autoload.php');
$nombre = '';
$apellido = '';
$fecha = '';
$profesion= '';
$email= '';
$fecha='';
$pass='';
$pass2='';
$genero='';
$pais= '';
$provincia= '';
$ciudad= '';
$terminos='';
$errores=[];

//GRABAR DATOS POST
if ($_POST){
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$profesion= trim($_POST['profesion']);
$fecha= $_POST['fecha'];
$email= strtolower(trim($_POST['email']));
$pass= trim($_POST['pass']);
$pass2= trim($_POST['pass2']);
if (isset($_POST ['genero'])) {$genero= $_POST['genero'];}
$pais= $_POST['pais'];
$provincia= $_POST['provincia'];
$ciudad= $_POST['ciudad'];
$terminos=$_POST['terminos']??null;
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Formulario</title>
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo_formulario.css">
  </head>
  <?php require_once('header.php'); ?>
  <body>
    <div class="cubo"><h3>
      <strong>¡Registrate!</strong>
    </h3>
    <br>


    <form class="todo" method="post" enctype="multipart/form-data">

    <fieldset class="fondo">

      <!-- AVISOS 1 -->
      <?php
      if($_POST){
        $errores = Validador::validarDatos($_POST, $conn);
        if(empty($errores)) {
          $passHash = password_hash($pass2, PASSWORD_DEFAULT);
          $usuario = new Usuario($email, $passHash);
          $usuario->setNombre($nombre);
          $usuario->setApellido($apellido);
          $usuario->setFecha($fecha);
          $usuario->setGenero($genero);
          $usuario->setCiudad($ciudad);
          $usuario->setProvincia($provincia);
          $usuario->setProfesion($profesion);
          $usuario->setPais($pais);

          $conn->grabarUsuario($usuario);

          header('location:registro-ok.php');
          exit;
        }
      }

       ?>



      <h1 class="titulo">Datos personales</h1>
      <hr>
      <br>
      <input class="<?php if ((isset($errores['nombre']))) {echo 'errorInput';} else {echo 'campo';}?>" type="text" name="nombre"  placeholder="Nombre" value="<?php echo $nombre;?>"><label class="requerido">*</label>
      <?php if($_POST) if(isset($errores['nombre'])) {echo $errores['nombre'];} ?>
      <br>
      <br>
      <input class="<?php if ((isset($errores['apellido']))) {echo 'errorInput';} else {echo 'campo';}?>" type="text" name="apellido"  placeholder="Apellido(s)" value="<?php echo $apellido;?>"><label class="requerido">*</label>
      <?php if($_POST) if(isset($errores['apellido'])) {echo $errores['apellido'];} ?>
      <br>
      <br>
      <label>Fecha de Nacimiento</label>
      <input type="date" class="<?php if ($_POST){if(isset($errores['fecha'])){echo 'errorDate';}}else{echo 'date';}?>" name='fecha' value="<?php echo $fecha; ?>">
      <?php if($_POST) if(isset($errores['fecha'])) {echo $errores['fecha'];} ?>
      </select>
        <br>
        <br>

          <input class="<?php if ((isset($errores['email']))) {echo 'errorInput';} else {echo 'campo';}?>" type="text" name="email" placeholder="Usuario@email.com" value = "<?php echo $email;?>"><label class="requerido">*</label>
            <?php if($_POST) if((isset($errores['email']))) {echo $errores['email'];} ?>
            <br>
            <br>

          <input class="<?php if (isset($errores['profesion']))  {echo 'errorInput';} else {echo 'campo';}?>" type="text" name="profesion" placeholder="Profesión" value = "<?php echo $profesion;?>"><label class="requerido">*</label>
            <?php if($_POST) if(isset($errores['profesion'])) {echo $errores['profesion'];} ?>
            <br>
            <br>

          <input class="<?php if (isset($errores['pass']) || (isset($errores['pass2']))) {echo 'errorInput';} else {echo 'campo';}?>" type="password"  name="pass" placeholder="Password"><label class="requerido">*</label>
            <?php if($_POST) if(isset($errores['pass'])) {echo $errores['pass'];} ?>
            <br>
            <br>

          <input class="<?php if (isset($errores['pass']) || (isset($errores['pass2']))) {echo 'errorInput';} else {echo 'campo';}?>" type="password"  name="pass2" placeholder="Repetir password" ><label class="requerido">*</label>
            <?php if($_POST){ if(isset($errores['pass2'])) {echo $errores['pass2'];}} ?>
            <br>
            <br>
        <label>Género</label>
        <br>
          <input type="radio" name="genero" value="Masculino" <?php if ($genero =="Masculino") {echo 'checked';}?> ><label class="radio">Masculino</label>
          <input type="radio" name="genero" value="Femenino" <?php if ($genero =="Femenino") {echo 'checked';}?>><label class="radio">Femenino</label>
          <input type="radio" name="genero" value="Otro" <?php if ($genero =="Otro") {echo 'checked';}?>><label class="radio">Otro</label>
          <br>
          <br>
          <select class="<?php if ((isset($errores['pais']))) {echo 'errorLocalidad';} else {echo 'localidad';}?>" name="pais" value ="<?php echo $pais;?>">
            <option><?php if ($pais == '') {echo "Seleccione un pais";} else {echo $pais;}?></option>
            <option>Argentina</option>
            <option>Brasil</option>
            <option>Chile</option>
            <option>Colombia</option>
            <option>Paraguay</option>
            <option>Uruguay</option>

          </select><label class="requerido">*</label>
          <?php if (isset($errores['pais'])) { echo $errores ['pais'];} ?>
          <br>
          <br>


          <select class="<?php if ((isset($errores['provincia']))) {echo 'errorLocalidad';} else {echo 'localidad';}?>" name="provincia" value ="<?php echo $provincia;?>">
            <option><?php if ($provincia == '') {echo "Seleccione una provincia";} else {echo $provincia;}?></option>
            <option>Buenos Aires</option>
            <option>Santa Fe</option>
            <option>Catamarca</option>
            <option>Corrientes</option>
            <option>Entre Rios</option>
            <option>Santiago del Estero</option>
            <option>Santa Cruz</option>
          </select><label class="requerido">*</label>
          <?php if (isset($errores['provincia'])) { echo $errores ['provincia'];} ?>
          <br>
          <br>

          <select class="<?php if ((isset($errores['ciudad']))) {echo 'errorLocalidad';} else {echo 'localidad';}?>" name="ciudad" value="<?php echo $ciudad;?>">
            <option><?php if ($ciudad == '') {echo "Seleccione una Ciudad";} else {echo $ciudad;}?></option>
            <option>Capital Federal</option>
            <option>Gran Buenos Aires</option>
            <option>Moron</option>
            <option>Haedo</option>
            <option>Gregorio de Laferrere</option>
            <option>San Justo</option>
            <option>Ciudad Evita</option>
          </select><label class="requerido">*</label>
          <?php if (isset($errores['ciudad'])) { echo $errores ['ciudad'];} ?>

        <br>
        <br>

          <p>Avatar (opcional)</p>
          <input type="file" name="avatar">
          <input type="hidden" name="max_file_size" value="30000">
          <?php if (isset($errores['avatar'])) { echo "<br><br> <p class='errorAvatar'>" .$errores ['avatar'] ."<p>";} ?>
          <br><br>

            <input class="check" type="checkbox" name="terminos"><a href="#"><label class="tyc">Acepto Terminos y Condiciones</label></a>
      <label class="requerido">* Campo requerido</label>
          <?php if (isset($errores['terminos'])) { echo $errores ['terminos'];} ?>


      </fieldset>


    <br>
    <br>
    <div class="botones">
      <button class="boton" type="submit" name="enviar">Enviar</button>
      <button class="boton" type="reset" name="" value="">Borrar</button>

    </div>

</form>
      <div class="separador"></div>
</div>


<?php require_once('footer.php'); ?>


  </body>
</html>

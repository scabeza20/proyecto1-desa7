<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/estilo.css">
  <title >Encuestados</title>
</head>
<body>
<h1>Bienvenido al sitio de Encuesta</h1>
<?php

header('Content-Type: text/html; charset=ISO-8859-1');
require_once('class/config.php');

$noticias = $conexion->prepare("
CALL `sp_listar_encuesta_random`()
");
// Ejecutamos la consulta
$noticias->execute();
$noticias = $noticias->fetchAll();

$noticias2 = $conexion->prepare("
CALL `sp_listar_encuesta_usuario`()
");

$noticias2->execute();
$noticias2 = $noticias2->fetchAll();
$porcentaje=0;
echo"Porcentaje de respuestas:\n". $porcentaje."%";
$nfilas=count ($noticias);


    foreach ($noticias as $resultado ) {
      ?>
        <form method='POST' action='procesar.php'>
        <p>&laquo;
        <input type='hidden' name='encid<?php printf($resultado['id'])?>' value='<?php printf($resultado['id'])?>'>
       <label><?php printf($resultado['encprg']) ?></label> </p>                                                             
      <input type='<?php printf($resultado['input'])?>' name='respuesta<?php printf($resultado['id'])?>' value='<?php printf($resultado['encrpt1'])?>' <?php printf($resultado['requerido'])?>> <?php printf($resultado['encrpt1'])?><br>
      <input type='<?php printf($resultado['input'])?>' name='respuesta<?php printf($resultado['id'])?>' value='<?php printf($resultado['encrpt2'])?>'><?php printf($resultado['encrpt2'])?><br>
      <input type='<?php printf($resultado['input'])?>' name='respuesta<?php printf($resultado['id'])?>' value='<?php printf($resultado['encrpt3'])?>'><?php printf($resultado['encrpt3'])?><br>
      <input type='<?php printf($resultado['input'])?>' name='respuesta<?php printf($resultado['id'])?>' value='<?php printf($resultado['encrpt4'])?>'><?php printf($resultado['encrpt4'])?><br>
        <?php
}
?>
 <input type='submit' name='Enviar Encuesta' value='votar'>
        </form>
</body>

</html>
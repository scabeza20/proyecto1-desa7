<?php
header('location', 'index.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <?php
    header('Content-Type: text/html; charset=ISO-8859-1');
    require_once('class/preguntas.php');

    $encuesta = new preguntas();
    $resultado = $encuesta->opciones_encuesta();

    //se realiza la consulta para dibujar el formulario de las preguntas para registrar la encuesta
    print("<div>");
    print("<h2>Registrece para realizar la encuesta</h2>");
    if(!empty($resultado)){
        print("<form name='enviar' action='vista.php' method='post'>");
        foreach($resultado as $datos){
            print("<div style='border: solid 1px'>");
            print("&laquo");
            print("<b>".$datos['id'].": ".$datos['pregunta']."</b>");
            print("<p><input name='pregunta".$datos['id']."' type='radio' value='".$datos['opcion1']."' required>".$datos['opcion1']."</p>");
            print("<p><input name='pregunta".$datos['id']."' type='radio' value='".$datos['opcion2']."' required>".$datos['opcion2']."</p>");
            print("<p><input name='pregunta".$datos['id']."' type='radio' value='".$datos['opcion3']."' required>".$datos['opcion3']."</p>");
            print("<p><input name='pregunta".$datos['id']."' type='radio' value='".$datos['opcion4']."' required>".$datos['opcion4']."</p>");
            print("</div>");
            print("<br>");
        }
        //se realiza una consulta a la tabla provincia y se crea una caja desplegable para que el usuario tome una opcion
        $provincia = new preguntas();
        $resultado = $provincia->provincia_encuesta();

        print("<div style='border: solid 1px'>");
        print("&laquo");
        print("<b>4: Provincia</b><br>");
        print("<select name='provincias'>");
        
        foreach($resultado as $n_provincia){
            print("<option value='".$n_provincia['provincia']."' required>".$n_provincia['provincia']."");
        }
        print("</select>");
        print("<br>");
        print("</div>");
        print("<br>");
        print("<input type='submit' name='enviar' value='Enviar'>");
        print("</form>");
    }else{
        print("No hay preguntas disponibles");
    }
    print("<br><br>");
    print("</div>");
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas para la Encuesta</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<h1>Modificar preguntas para la encuesta</h1>
<section style="display:flex; justify-content: space-around">
<body>
    <?php
    header('Content-Type: text/html; charset=ISO-8859-1');
     require_once('class/preguntas.php');
     
     $preguntas = new preguntas();
     $mensaje = "";
     $id = 0;

    if(array_key_exists('aceptar', $_POST)){
        require_once("class/preguntas.php");
        $preguntas = new preguntas();
        if(!empty($_POST['pregunta'])){
            $resulatdo = $preguntas->crear_preguntas($_POST['pregunta'], $_POST['opcion1'], 
            $_POST['opcion2'], $_POST['opcion3'], $_POST['opcion4']);
        }else{
            $mensaje = "Introduzca una pregunta.";
        }
    }

    if(isset($_GET['eliminar'])){
        require_once("class/preguntas.php");
        $preguntas = new preguntas();
        $resulatdo = $preguntas->eliminar_pregunta($_GET['eliminar']);
    }

    if(isset($_GET['modificar'])){
        $id = $_GET['modificar'];
    }

    if(array_key_exists('modificar', $_POST)){
        require_once("class/preguntas.php");
        $preguntas = new preguntas();
        $resulatdo = $preguntas->modificar_pregunta($_POST['id'], $_POST['pregunta'], $_POST['opcion1'], $_POST['opcion2'], $_POST['opcion3'], $_POST['opcion4']);
    }

    $preguntas = new preguntas();
    $resultado = $preguntas->listar_preguntas();

    print("<div style='margin: 10px;'>");
    print("<h2>Preguntas para la encuesta</h2>");
    if(!empty($resultado)){
        print("<TABLE>\n");
        print("<TR>\n");
        print("<TH>Pregunta</TH>\n");
        print("<TH>Opcion 1</TH>\n");
        print("<TH>Opcion 2</TH>\n");
        print("<TH>Opcion 3</TH>\n");
        print("<TH>Opcion 4</TH>\n");
        print("<TH></TH>\n");
        print("</TR>\n");
        
        foreach($resultado as $pregunta){
            print("<TR style='height: 60px'>\n");
            print("<TD style='width: 200px'>".$pregunta['encprg']."</TD>\n");
            print("<TD>".$pregunta['encrpt1']."</TD>\n");
            print("<TD>".$pregunta['encrpt2']."</TD>\n");
            print("<TD>".$pregunta['encrpt3']."</TD>\n");
            print("<TD>".$pregunta['encrpt4']."</TD>\n");
            print("<TD><a href='" . $_SERVER['PHP_SELF'] . "?modificar=" . $pregunta['id'] . "'>Modificar</a> / 
            <a href='" . $_SERVER['PHP_SELF'] . "?eliminar=" . $pregunta['id'] . "'>Eliminar</a></TD>\n");
            print("</TR>\n");
        }
        print("</TABLE>\n");
    }else{
        print("No hay preguntas disponibles");
    }
    print("<br><br>");
    print("</div>");
    ?>

    <div style="width: 450px; margin: 10px;">
    <?php
    $preguntas = new preguntas();
    $resulatdo = $preguntas->listar_pregunta($id);
    if (!empty($resulatdo)) {
        foreach($resulatdo as $pregunta){
            print("<h2>Modificar Pregunta</h2>");
            print("<form name='modificar' action='crud.php' method='post'>");
            print("<input name='id' type='hidden' value='" . $pregunta['id'] . "'>");
            print("<p><label>Pregunta: </label> <input name='pregunta' type='text' value='" . $pregunta['encprg'] . "' required> <b>*</b></p><br>");
            print("<b>Posibles respuestas:</b>");
            print("<p><label>Opcion 1: </label> <input name='opcion1' type='text' value='" . $pregunta['encrpt1'] . "' required> <b>*</b></p>");
            print("<p><label>Opcion 2: </label> <input name='opcion2' type='text' value='" . $pregunta['encrpt2'] . "' required> <b>*</b></p>");
            print("<p><label>Opcion 3: </label> <input name='opcion3' type='text' value='" . $pregunta['encrpt3'] . "'></p>");
            print("<p><label>Opcion 4: </label> <input name='opcion4' type='text' value='" . $pregunta['encrpt4'] . "'></p>");
            print("<p><b>*</b> Campos obligatorios</p>");
            print("<input type='submit' name='modificar' value='Modificar'>");
            print("</form>");
        }
    }else{
        print("<h2>Crear nuevas preguntas</h2>");
        print("<form name='insertar' action='crud.php' method='post'>");
        print("<p><label>Pregunta: </label> <input name='pregunta' type='text' required> <b>*</b></p><br>");
        print("<b>Posibles respuestas:</b>");
        print("<p><label>Opcion 1: </label> <input name='opcion1' type='text' required> <b>*</b></p>");
        print("<p><label>Opcion 2: </label> <input name='opcion2' type='text' required> <b>*</b></p>");
        print("<p><label>Opcion 3: </label> <input name='opcion3' type='text' required> <b>*</b></p>");
        print("<p><label>Opcion 4: </label> <input name='opcion4' type='text' required> <b>*</b></p>");
        print("<p><b>*</b> Campos obligatorios</p>");
        print("<input type='submit' name='aceptar' value='Insertar'>");
        print("</form>");
    }
    print("<p>$mensaje</p>"); ?>
    </div>
    </section>
</body>
</html>
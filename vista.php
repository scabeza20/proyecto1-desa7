<HTML LANG="es">
<HEAD>
<TITLE >Registro</TITLE>
<LINK REL= " stylesheet" TYPE= "text/css" href= "css/estilo.css">
</HEAD>
<BODY>
<?PHP
    header('Content-Type: text/html; charset=ISO-8859-1');
    require_once("class/preguntas.php" );
    require_once('procesar.php');

    if(array_key_exists('enviar', $_POST)){
        $encuesta = new preguntas();
        $resultado = $encuesta->listar_opciones_encuesta();
        
        //se realiza una consulta a la tabla de preguntas para registrar la encuesta
        foreach ($resultado as $opciones) {
            $id = $opciones['id'];
            $op1 = $opciones['opcion1'];
            $op2 = $opciones['opcion2'];
            $op3 = $opciones['opcion3'];
            $op4 = $opciones['opcion4'];
            $voto1 = $opciones['voto1'];
            $voto2 = $opciones['voto2'];
            $voto3 = $opciones['voto3'];
            $voto4 = $opciones['voto4'];
            
            //se toma la opcion de cada pregunta agrupada por nombre pregunta1, pregunta2 o pregunta3
            $opcion = $_REQUEST['pregunta'.$id];
            //se comparan todas las opciones para saber cual fue selecionada por cada pregunta
            if($opcion == $op1){
                ($voto1 = $voto1 + 1);
            
            }else if($opcion == $op2){
                ($voto2 = $voto2 + 1);
            
            }else if($opcion == $op3){
                ($voto3 = $voto3 + 1);
            
            }else if($opcion == $op4){
                ($voto4 = $voto4 + 1);
            }
            //se realiza una consulta para actualizar los votos por las opciones seleccionadas por el usuario en cada pregunta
            $actualizar = new preguntas();
            $result = $actualizar->actualizar_votos_registro_encuesta($id, $voto1, $voto2, $voto3, $voto4);
        }

        //se realiza una consulta a la tabla provincia y se compara para saber la opcion selecionada
        $provincia = new preguntas();
        $resultado_provincia = $provincia->provincia_encuesta();
        
        $provincia_seleccionada = $_REQUEST['provincias'];
        foreach ($resultado_provincia as $datos) {
            $id_provincia = $datos['id'];
            $opcion_provincia = $datos['provincia'];
            $voto = $datos['voto'];

            if($provincia_seleccionada == $opcion_provincia){
                $voto = $voto + 1;
            }
            //se realiza una consulta a la tabla porvincia para actualizar la opcion selecionada por el usuario
            $actualizar_provincia = new preguntas();
            $result_provincia = $actualizar_provincia->actualizar_votos_provincia($id_provincia, $voto);
        }
    }


    if(array_key_exists('enviar_encuesta', $_POST)){
        print("<h2>Sus respuetas han sido enviadas.\nGracias por participar.</h2>");
        print("<p><a href='reporte.php'>Ver Resultados</a></p>");
        print("<p><a href='Registro_encuesta.php'>Realizar la Encuesta de Nuevo</a></p>");
        
    }else{
        print("<H1>Bienvenido al sitio de Encuesta</H1>");

        $obj_preguntas = new preguntas();
        $noticias = $obj_preguntas->listar_random();
        $porcentaje = 0;
        
        $nfilas = count ($noticias);
        $n_preguntas = array();
        $porcentaje=0;
        $uno=1;
        if ($nfilas > 0){
            print("<form name='FormEncuesta' method='POST' action='procesar.php'>");
                      
            foreach ($noticias as $resultado) {
               
                print("<div style='border: solid 1px'>");
                print("&laquo");
                print("<input type='hidden' name='encid".$resultado['id']."' value='".$resultado['id']."'>");
                print("<b><label>".$resultado['encprg']."</label></b><br>");
                print("<input type='".$resultado['input']."' name='respuesta".$resultado['id']."' value='".$resultado['encrpt1']."'>".$resultado['encrpt1']."<br>");
                print("<input type='".$resultado['input']."' name='respuesta".$resultado['id']."' value='".$resultado['encrpt2']."' >".$resultado['encrpt2']."<br>");
                print("<input type='".$resultado['input']."' name='respuesta".$resultado['id']."' value='".$resultado['encrpt3']."' >".$resultado['encrpt3']."<br>");
                print("<input type='".$resultado['input']."' name='respuesta".$resultado['id']."' value='".$resultado['encrpt4']."' >".$resultado['encrpt4']."<br>");
                print("</div>");
                print("<br>");
            }
            
            print("<input type='submit' name='enviar_encuesta' value='Votar'>");
           // printf(" <progress id='file' max='".$nfilas."' value='".$porcentaje."'>  </progress>");
            print("</form>");
            
        }else{
            print ("No hay noticias disponibles" );
        }
    }
?>
</BODY>
</HTML>
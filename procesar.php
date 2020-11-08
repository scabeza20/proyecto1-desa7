<?php
    require_once('class/preguntas.php');
    require_once("vista.php");
    
    //se realiza un aconsulta para saber cuantas preguntas hay en base de datos
    $preguntas = new preguntas();
    $resultado = $preguntas->listar_preguntas();
    $i = sizeof($resultado);//se asigna la cantidad de preguntas a la variable i
    $x=1;
    //con un bucle recorremos todas las preguntas se haya o o se hayan escojido para la encuesta
    while($x <= $i){
        //se pregunta si el valor de encid en el formulario de envio existe
        //si existe se procede a validar que opcion escogio el usuario
        //de lo contrario se omite el precedimeinto y se continua con el siguiente valor
        if(isset($_REQUEST['encid'.$x])){
            $encid = $_REQUEST['encid'.$x];//encid representa el id de la pregunta en la base de datos
            $respuesta = $_REQUEST['respuesta'.$encid];//el valor escogido por elusuario se almacena en respuesta
            $pregunta = new preguntas();
            $resultado = $pregunta->listar_pregunta($x);//se realiza una consulta por id de la pregunta (valor de x)

            //el resultado de consulta anterior lo alamcenamos en las sguientes variables para comparar que opcion escogio el usuario y sumar el voto
            foreach($resultado as $dato){
                $votos1 = $dato['encval1'];
                $votos2 = $dato['encval2'];
                $votos3 = $dato['encval3'];
                $votos4 = $dato['encval4'];
            }
            
            //se comparar la opciones y se suma el voto
            if($respuesta == $dato['encrpt1']){
                $votos1 = $votos1 + 1;
                print("Opcion 1:");
                
            }else if($respuesta == $dato['encrpt2']){
                $votos2 = $votos2 + 1;
                print("Opcion 2:");
                
            }else if($respuesta == $dato['encrpt3']){
                $votos3 = $votos3 + 1;
                print("Opcion 3:");
                
            }else if($respuesta == $dato['encrpt4']){
                $votos4 = $votos4 + 1;
                print("Opcion 4:");
            }
            
            //se realiza la consulta para actualizar los votos por cada pregunta
            $insertar = new preguntas();
            $instruccion = $insertar->insertar_votos($votos1, $votos2, $votos3, $votos4, $encid);
            }
            $x = $x+1;
        }
?>
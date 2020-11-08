<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once("vista.php" );

require_once('class/config.php');
    
$noticias = $conexion->prepare("
CALL `sp_listar_encuesta_ordenado`()
");
    
// Ejecutamos la consulta
$noticias->execute();
$noticias = $noticias->fetchAll();
    $result_votos = $noticias;
    $respuesta_voto1 = array();
    $respuesta_voto2 = array();
    $respuesta_voto3 = array();
    $respuesta_voto4 = array();
        
    foreach($result_votos as $result_voto){ 

        $votos1=$result_voto['encval1'];
        $votos2=$result_voto['encval2'];
        $votos3=$result_voto['encval3'];
        $votos4=$result_voto['encval4'];    
       $encid = $_REQUEST['encid'.$result_voto['id']];    
       $respuesta_voto1[$result_voto['id']] = $_REQUEST['respuesta'.$encid];
       $respuesta_voto2[$result_voto['id']]  = $_REQUEST['respuesta'.$encid];
       $respuesta_voto3[$result_voto['id']]  = $_REQUEST['respuesta'.$encid];
       $respuesta_voto4[$result_voto['id']]  = $_REQUEST['respuesta'.$encid];
    
    if( $respuesta_voto1[$result_voto['id']]==$result_voto['encrpt1']){
        $votos1 = $votos1+1;
    }
    elseif( $respuesta_voto2[$result_voto['id']]==$result_voto['encrpt2']){
        $votos2 = $votos2+1;
    }
    elseif( $respuesta_voto3[$result_voto['id']]==$result_voto['encrpt3']){
        $votos3 = $votos3+1;
    }
    elseif( $respuesta_voto4[$result_voto['id']]==$result_voto['encrpt4']){
        $votos4 = $votos4+1;
    }
      
    $instruccion = $conexion->prepare("
    CALL `sp_ingresar_encuesta`('".$votos1."', '".$votos2."', '".$votos3."', '".$votos4."', '".$encid."')
    ");

// Ejecutamos la consulta
$instruccion->execute();
//$instruccion = $instruccion->fetchAll();
    }
   
    ?>
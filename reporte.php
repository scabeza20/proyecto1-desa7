<html lang ="es">
<head>
  <title>Reportes</title>
  <link REL ="stylesheet" TYPE ="text/css" HREF="css/estilo.css">
</HEAD>
<BODY>
  
  <?php
  header('Content-Type: text/html; charset=ISO-8859-1');
  require_once('class/preguntas.php');
  ?>
  <H1>REPORTES  </H1>
      <h2>Ver reporte por: </h2>
      <form action="reporte.php" method='post'>
        <select name="ordenar_por">
          <option value="Sexo">Sexo</option>
          <option value="Rango de Edad">Rango de Edad</option>
          <option value="Rango Salarial">Rango Salarial</option>
          <option value="Provincia">Provincia</option>
        </select>
        <input type="submit" name="ordenar" value="Enviar">
      </form>
      <?php
      print("[ <a href='index.php'>Ir a Registro de Encuesta</a> / <a href='crud.php'>Editar preguntas para la encuesta</a> ]");
    
    if(array_key_exists('ordenar', $_POST)){
      $reporte = new preguntas();
  
      $orden = $_REQUEST['ordenar_por'];
      if($orden == "Sexo"){
        $resultado = $reporte->contador_sexo();
        OrdenReporte($resultado);
        
      }else if($orden == "Rango de Edad"){
        $resultado = $reporte->contador_rango_edad();
        OrdenReporte($resultado);
  
      }else if($orden == "Rango Salarial"){
        $resultado = $reporte->contador_rango_salario();
        OrdenReporte($resultado);
  
      }else if($orden == "Provincia"){
        $encuesta = new preguntas();
        $result = $encuesta->contador_total_encuesta();
        $resultado = $reporte->contador_provincia();
        foreach($result as $total){
          print("<p>Total de Encuestas Realizadas: ".$total['Total de encuestas']."<p>");
        }
          print("<TABLE>\n");
          print("<TR>\n");
          print("<TH>Provincia</TH>\n");
          print("<TH>Cantidad</TH>\n");
          print("</TR>\n");

         foreach($resultado as $dato){
          print("<TR>\n");
          print("<TD>".$dato['provincia']."</TD>\n");
          print("<TD>".$dato['voto']."</TD>\n");
          print("</TR>\n");
        }
        print("</TABLE>\n");
      }
    }
  function OrdenReporte($resultado){
    $encuesta = new preguntas();
    $result = $encuesta->contador_total_encuesta();
    foreach($result as $total){
      print("<p>Total de Encuestas Realizadas: ".$total['Total de encuestas']."<p>");
    }
    
    foreach($resultado as $dato){
        print("<TABLE>\n");
        print("<TR>\n");
        print("<TH>".$dato['opcion1']."</TH>\n");
        print("<TH>".$dato['opcion2']."</TH>\n");
        print("<TH>".$dato['opcion3']."</TH>\n");
        print("<TH>".$dato['opcion4']."</TH>\n");
        print("</TR>\n");
      
      
        print("<TR>\n");
        print("<TD>".$dato['voto1']."</TD>\n");
        print("<TD>".$dato['voto2']."</TD>\n");
        print("<TD>".$dato['voto3']."</TD>\n");
        print("<TD>".$dato['voto4']."</TD>\n");
        print("</TR>\n");
      }
      print("</TABLE>\n");
    }
   ?>
 </BODY>
</HTML>

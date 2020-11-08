<?php
require_once("modelo.php");

class preguntas extends modeloCredencialesDB{

    public function __construct(){
        parent::__construct();
    }

    public function opciones_encuesta(){
        $instruccion = "CALL sp_opciones_encuestados()";
        $consulta = $this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

        if($resultado){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function provincia_encuesta(){
        $instruccion = "CALL sp_listar_provincias()";
        $consulta = $this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

        if($resultado){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function listar_opciones_encuesta(){
        $instruccion = "CALL sp_listar_opciones_encuesta()";
        $consulta = $this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

        if($resultado){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function actualizar_votos_registro_encuesta($id, $voto1, $voto2, $voto3, $voto4){
        $instruccion = "CALL sp_actualizar_registro_encuestados('".$id."', '".$voto1."', '".$voto2."', '".$voto3."', '".$voto4."')";
        $crear = $this->_db->query($instruccion);

        if($crear){
            return $crear;
            $crear->close();
            $this->_db->close();
        }
    }

    public function listar_provincia_encuesta(){
        $instruccion = "CALL sp_listar_provincias()";
        $consulta = $this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

        if($resultado){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function actualizar_votos_provincia($id, $voto){
        $instruccion = "CALL sp_actualizar_votos_provincia('".$id."', '".$voto."')";
        $crear = $this->_db->query($instruccion);

        if($crear){
            return $crear;
            $crear->close();
            $this->_db->close();
        }
    }

    public function listar_preguntas(){
        $instruccion = "CALL sp_listar_preguntas()";
        $consulta = $this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

        if($resultado){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function crear_preguntas($pregunta, $opcion1, $opcion2, $opcion3, $opcion4){
        $instruccion = "CALL sp_crear_preguntas('".$pregunta."', '".$opcion1."', '".$opcion2."', '".$opcion3."', '".$opcion4."')";
        $crear=$this->_db->query($instruccion);

        if($crear){
            return $crear;
            $crear->close();
            $this->_db->close();
        }
    }

    public function eliminar_pregunta($id){
        $instruccion = "CALL sp_eliminar_pregunta('".$id."')";
        $crear=$this->_db->query($instruccion);

        if($crear){
            return $crear;
            $crear->close();
            $this->_db->close();
        }
    }

    public function listar_pregunta($id){
        $instruccion = "CALL sp_listar_pregunta('".$id."')";

        $consulta = $this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);

        if($resultado){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function modificar_pregunta($id, $pregunta, $opcion1, $opcion2, $opcion3, $opcion4){
        $instruccion = "CALL sp_modificar_pregunta('".$id."', '".$pregunta."', '".$opcion1."', '".$opcion2."', '".$opcion3."', '".$opcion4."')";
        $crear=$this->_db->query($instruccion);
        
        if($crear){
            return $crear;
            $crear->close();
            $this->_db->close();
        }
    }

    public function consultar_maximo(){
        $instruccion = "CALL sp_consultar_maximo()";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        
        if ($resultado){
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    //contador cantidad
    public function contador_sexo (){
        $instruccion = "CALL sp_contador_sexo()";
        $consulta=$this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);
        if ($resultado){
            return $resultado;
            $rsultado->close();
            $this->_db->close();
        }
    }
    
    //rango de edad
    public function contador_rango_edad (){
        $instruccion = "CALL sp_contador_rango_edad()";
        $consulta=$this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);
        if ($resultado){
            return $resultado;
            $rsultado->close();
            $this->_db->close();
        }
    }
    
    //rango de salario
    public function contador_rango_salario (){
        $instruccion = "CALL sp_contador_rango_salario()";
        $consulta=$this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);
        
        if ($resultado){
            return $resultado;
            $rsultado->close();
            $this->_db->close();
        }
    }
    
    //rango de salario
    public function contador_provincia (){
        $instruccion = "CALL sp_contador_provincia()";
        $consulta=$this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);
        
        if ($resultado){
            return $resultado;
            $rsultado->close();
            $this->_db->close();
        }
    }
    public function contador_total_encuesta (){
        $instruccion = "CALL sp_contador_encuesta()";
        $consulta=$this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);
        
        if ($resultado){
            return $resultado;
            $rsultado->close();
            $this->_db->close();
        }
    }

    public function listar_random(){
        $instruccion = "CALL sp_listar_random()";
        $consulta=$this->_db->query($instruccion);
        $resultado=$consulta->fetch_all(MYSQLI_ASSOC);
        
        if ($resultado){
            return $resultado;
            $rsultado->close();
            $this->_db->close();
        }
    }

    public function insertar_votos($voto1, $voto2, $voto3, $voto4, $id){
        $instruccion = "CALL sp_ingresar_encuesta('".$voto1."', '".$voto2."', '".$voto3."', '".$voto4."', '".$id."')";
        $crear=$this->_db->query($instruccion);
        
        if($crear){
            return $crear;
            $crear->close();
            $this->_db->close();
        }
    }
}
?>
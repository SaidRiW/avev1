<?php

include_once 'cBaseDatos.php';

//Clase EventosP
class cEventosP {
	
	//Atributos de la clase	
	private $idevento;
	private $matricula;
	private $titulo;
	private $fecha_hora;
    private $descripcion;
    private $prioridad;
	
	//Constructor por default	
    function __construct() {
			$this->idevento="";
			$this->matricula="";
			$this->titulo="";
			$this->fecha_hora="";
            $this->descripcion="";
            $this->prioridad="";
	}


    //Métodos setters para todas las propiedades		
    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setFechaHora($fecha_hora) {
        $this->fecha_hora = $fecha_hora;
    } 

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    } 

    function setPrioridad($prioridad) {
        $this->prioridad = $prioridad;
    }   

    function setIdEvento($idevento) {
        $this->idevento = $idevento;
    }
	
	function setMatricula($matricula) {
		$this->matricula = $matricula;
	}

    //Faltan los demás setters

   //Métodos getters para todas las propiedades
    function getIdEvento() {
        return $this->idevento;
    }

    function getDescripcion() {
        return $this->$descripcion;
    }

    //Faltan los demás getters
    

	//Método guardaEvento, usado para registrar un evento personal en la BD
    function guardaEvento(){   
		
		session_start();

		$colorEvento;

		if($this->prioridad == "ALTA"){
			$colorEvento = "red";
		}
		else if ($this->prioridad == "MEDIA"){
			$colorEvento = "orange";
		}
		else if ($this->prioridad == "BAJA"){
			$colorEvento = "yellow";
		}

	    $baseDatos = new cBaseDatos();
    	$sentenciaSQL="INSERT INTO eventos_personales (matricula, titulo, fecha_hora, descripcion, prioridad, color) VALUES (". $_SESSION['Matricula'] ." ,'$this->titulo', '$this->fecha_hora', '$this->descripcion', '$this->prioridad', '$colorEvento')"; 
		
        $result = $baseDatos->insertarRegistro($sentenciaSQL);

		$response = array();


	    if ($result) {
       
    		$response["success"] = 1;
        	$response["message"] = "Evento creado correctamente.";
    	} else {
       
        	$response["success"] = 0;
        	$response["message"] = "Oops! Ocurrió un error!!";
       
    	}
 		
		return $response;
		 
    }//Fin método guardaEvento


	//Método actualizaDatosEvento, usado para actualizar un evento personal en la BD
    function actualizaDatosEvento(){     
	    $baseDatos = new cBaseDatos();
	    $sentenciaSQL="UPDATE eventos_personales set titulo='$this->titulo', fecha_hora='$this->fecha_hora', descripcion='$this->descripcion', prioridad='$this->prioridad' WHERE idevento='$this->idevento'"; 
		$result = $baseDatos->modificarRegistro($sentenciaSQL);
		$response = array();
		if ($result>0) {       
        	$response["success"] = 1;
        	$response["message"] = "Evento modificado correctamente.";
	    } else {
    	    $response["success"] = 0;
        	$response["message"] = "Oops! Ocurrió un error!!";       
    	}
		return $response;		 
    }//Fin método actualizaDatosEvento


	//Método eliminaEvento, usado para eliminar un evento personal en la BD
    function eliminaEvento(){     

	    $baseDatos = new cBaseDatos();


	    $sentenciaSQL="DELETE from eventos_personales WHERE idevento='$this->idevento'"; 
		$result = $baseDatos->eliminarRegistro($sentenciaSQL);
	
    	if ($result) {
        
        	$response["success"] = 1;
        	$response["message"] = "Evento eliminado correctamente.";
    	} else {
       
        	$response["success"] = 0;
        	$response["message"] = "Oops! Ocurrió un error!!";      
    	}

		return $response;
		 
    }//Fin método eliminaEvento


	//Método consultaEventoP, usado para consultar registros de un Evento en la BD
    function consultaEventoP(){     
	    
		$baseDatos = new cBaseDatos();
		
		$sentenciaSQL="SELECT idevento, titulo, fecha_hora, descripcion, prioridad ";
        $sentenciaSQL = $sentenciaSQL . "from eventos_personales ";
        $sentenciaSQL = $sentenciaSQL . "WHERE idevento=". $this->idevento;
  
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
		$result = array();
		if ($rs->num_rows > 0){
	    	while($row = $rs->fetch_assoc()){
                $result[]=  $row;
			}
		}
		else{
        
        	$result["error"] = 1;
        	$result["message"] = "El evento no existe en la BD.";
		
		}

		return $result;
		 
    }//Fin método consultaEventoP


    
    //Método consultaEventosP, usado para consultar registros de todos los eventos en la BD
    function consultaEventosP(){    
		
		session_start();
        
        $baseDatos = new cBaseDatos();
        
        $sentenciaSQL="SELECT distinct idevento, titulo, fecha_hora, descripcion, prioridad ";
        $sentenciaSQL = $sentenciaSQL . "from eventos_personales WHERE matricula=" . $_SESSION['Matricula'] . " order by titulo";  




        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array('data' => array());
        if ($rs->num_rows > 0){           
           while($row = $rs->fetch_assoc()){
                $result['data'][] = $row; 

            }
        
        }
        
        return $result;
         
    }//Fin método consultaEventosP

} //Fin clase EventosP

?>
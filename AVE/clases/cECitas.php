<?php

include_once 'cBaseDatos.php';

//Clase citas
class cECitas {
	
	//Atributos de la clase	
	private $idcita;
	private $idadmin;
	private $matricula;
	private $idservicio;
    private $fecha_hora;
    private $idgrupo;
	
	//Constructor por default	
    function __construct() {
			$this->idcita="";
			$this->idadmin="";
            $this->matricula="";
			$this->idservicio="";
            $this->fecha_hora="";
            $this->idgrupo="";
	}


    //Métodos setters para todas las propiedades		

    function setFechaHora($fecha_hora) {
        $this->fecha_hora = $fecha_hora;
    } 

    function setIdGrupo($idgrupo) {
        $this->idgrupo = $idgrupo;
    }   

    function setIdCita($idcita) {
        $this->idcita = $idcita;
    }
	
	function setMatricula($matricula) {
		$this->matricula = $matricula;
	}

	function setIdServicio($idservicio) {
		$this->idservicio=$idservicio;
	}

    //Faltan los demás setters

   //Métodos getters para todas las propiedades
    function getIdCita() {
        return $this->idcita;
    }

    //Faltan los demás getters

	//Método registraCita, usado para registrar una cita en la BD
	function registraCita(){     

		session_start();

		$baseDatos = new cBaseDatos();

		// Obtener idadmin del servicio dado
		$sentenciaSQLAdmin = "SELECT idadmin FROM administradores WHERE idservicio = '$this->idservicio'";
		$resultadoAdmin = $baseDatos->consultaRegistros($sentenciaSQLAdmin); // Asumiendo que hay un método de consulta en la clase cBaseDatos

		// Verificar si se obtuvo un resultado
		if ($resultadoAdmin && $fila = $resultadoAdmin->fetch_assoc()) {
			$idadmin = $fila['idadmin'];

			$sentenciaSQL="INSERT into citas (idadmin, matricula, idservicio, fecha_hora, idgrupo) values ($idadmin, " . $_SESSION['Matricula'] . " , '$this->idservicio', '$this->fecha_hora'," . $_SESSION['IDGrupo'] . " )"; 

			//Insertar notificación
			$sentenciaSQLNoti = "INSERT into notificaciones (Usuario1, Usuario2, Tipo, Leido, Fecha) values ( " . $_SESSION['Matricula'] . " , $idadmin, '(Cita)', '0', now())";
			$resultNoti = $baseDatos->insertarRegistro($sentenciaSQLNoti);

		
			$result = $baseDatos->insertarRegistro($sentenciaSQL);

			$response = array();

			if ($result) {
				$response["success"] = 1;
				$response["message"] = "Cita agendada correctamente.";
			} else {
				$response["success"] = 0;
				$response["message"] = "Oops! Ocurrió un error!!";
			}

			return $response;
		} else {
			// Si no se obtiene un resultado, manejar el caso en consecuencia
			$response = array();
			$response["success"] = 0;
			$response["message"] = "No se encontró un idadmin para el idservicio proporcionado.";
			return $response;
		}
	}//Fin método registraCita


	//Método actualizaDatosCita, usado para actualizar una cita en la BD
    function actualizaDatosCita(){     
	    $baseDatos = new cBaseDatos();
	    $sentenciaSQL="UPDATE citas set matricula='$this->matricula', fecha_hora='$this->fecha_hora' WHERE idcita='$this->idcita'"; 
		$result = $baseDatos->modificarRegistro($sentenciaSQL);
		$response = array();
		if ($result>0) {       
        	$response["success"] = 1;
        	$response["message"] = "Cita modificada correctamente.";
	    } else {
    	    $response["success"] = 0;
        	$response["message"] = "Oops! Ocurrió un error!!";       
    	}
		return $response;		 
    }//Fin método actualizaDatosCita

	//Método consultaCita, usado para consultar registros de una cita en la BD
    function consultaCita(){     
	    
		$baseDatos = new cBaseDatos();
		
		$sentenciaSQL="SELECT idcita, matricula, fecha_hora ";
        $sentenciaSQL = $sentenciaSQL . "from citas ";
        $sentenciaSQL = $sentenciaSQL . "WHERE idcita=". $this->idcita;
  
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
		$result = array();
		if ($rs->num_rows > 0){
	    	while($row = $rs->fetch_assoc()){
                $result[]=  $row;
			}
		}
		else{
        
        	$result["error"] = 1;
        	$result["message"] = "La cita no existe en la BD.";
		
		}

		return $result;
		 
    }//Fin método consultaCita


    
    //Método consultaCitas, usado para consultar registros de todos las citas en la BD
    function consultaCitas(){     
        
        $baseDatos = new cBaseDatos();
        
        $sentenciaSQL="SELECT distinct c.idcita, c.fecha_hora, CONCAT(e.nombres, ' ', e.apellidopaterno, ' ', e.apellidomaterno) AS nombre_estudiante, g.nombre ";
        $sentenciaSQL = $sentenciaSQL . "from citas c ";   
        $sentenciaSQL = $sentenciaSQL . "INNER join catalogo_grupos g on c.idgrupo = g.idgrupo ";
        $sentenciaSQL = $sentenciaSQL . "INNER join estudiantes e on c.matricula = e.matricula ";
        $sentenciaSQL = $sentenciaSQL . "Order by nombre_estudiante";




        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array('data' => array());
        if ($rs->num_rows > 0){           
           while($row = $rs->fetch_assoc()){
                $result['data'][] = $row; 

            }
        
        }
        
        return $result;
         
    }//Fin método consultaCitas


  


} //Fin clase citas

?>
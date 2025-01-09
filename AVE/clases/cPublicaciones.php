<?php

include_once 'cBaseDatos.php';

//Clase publicaciones
class cPublicaciones {
	
	//Atributos de la clase	
	private $idpublicacion;
	private $idadmin;
	private $idservicio;
	private $titulo;
	private $fechainicio;
    private $fechafin;
    private $descripcion;
    private $prioridad;
    private $idgrupo;
    private $imagen;
	
	//Constructor por default	
    function __construct() {
			$this->idpublicacion="";
			$this->idadmin="";
			$this->idservicio="";
			$this->titulo="";
			$this->fechainicio="";
            $this->fechafin="";
            $this->descripcion="";
            $this->prioridad="";
            $this->idgrupo="";
            $this->imagen="";
	}


    //Métodos setters para todas las propiedades		
    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setFechaInicio($fechainicio) {
        $this->fechainicio = $fechainicio;
    } 

    function setFechaFin($fechafin) {
        $this->fechafin = $fechafin;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    } 

    function setPrioridad($prioridad) {
        $this->prioridad = $prioridad;
    }

    function setIdGrupo($idgrupo) {
        $this->idgrupo = $idgrupo;
    }
    
    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setIdPublicacion($idpublicacion) {
        $this->idpublicacion = $idpublicacion;
    } 
    
    function setIdAdmin($idadmin) {
        $this->idadmin = $idadmin;
    }

    //Faltan los demás setters

   //Métodos getters para todas las propiedades
    function getIdPublicacion() {
        return $this->idpublicacion;
    }
    
    function getIdAdmin(){
        return $this->idadmin;
    }

    //Faltan los demás getters
    

	//Método guardaPublicacion, usado para registrar una publicación en la BD
    
    function guardaPublicacion(){   
        
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
    	$sentenciaSQL="INSERT INTO publicaciones (idadmin, idservicio, titulo, fechainicio, fechafin, descripcion, prioridad, idgrupo, imagen, color) VALUES (". $_SESSION['IDAdmin'] ." ," . $_SESSION['IDServicio'] ." ,'$this->titulo', '$this->fechainicio', '$this->fechafin', '$this->descripcion', '$this->prioridad', $this->idgrupo, '$this->imagen', '$colorEvento')"; 
		
        // Utilizar la función modificada para insertar y obtener el ID
        $nuevoIdPublicacion = $baseDatos->insertarRegistroYObtenerID($sentenciaSQL);

		//Insertar notificación
        $sentenciaSQLNoti = "INSERT INTO notificaciones (Usuario1, Usuario2, Tipo, Leido, Fecha)
                     SELECT " . $_SESSION['IDAdmin'] . ", Matricula, '(Publicación)', '0', NOW()
                     FROM estudiantes
                     WHERE idgrupo = '$this->idgrupo'";

		$resultNoti = $baseDatos->insertarRegistro($sentenciaSQLNoti);

        //Insertar relación con estudiante
        $sentenciaSQLRel = "INSERT INTO estudiantes_publicaciones (id_estudiante, id_publicacion, eliminada) 
        SELECT Matricula AS id_estudiante, $nuevoIdPublicacion AS id_publicacion, 0 AS eliminada
        FROM estudiantes
        WHERE idgrupo = '$this->idgrupo'";

        $resultRel = $baseDatos->insertarRegistro($sentenciaSQLRel);

		$response = array();

        if ($nuevoIdPublicacion && $resultNoti && $resultRel) {
            $response["success"] = 1;
            $response["message"] = "Publicación creada correctamente.";
        } else {
            $response["success"] = 0;
            $response["message"] = "Oops! Ocurrió un error al crear la publicación.";
    
            // Puedes añadir más detalles sobre el error si es necesario
            $response["error_details"] = "Detalles del error: ...";
        }
 		
		return $response;
		 
    }//Fin método guardaPublicacion

	//Método actualizaDatosPublicacion, usado para actualizar una Publicación en la BD
    function actualizaDatosPublicacion(){     
	    $baseDatos = new cBaseDatos();
	    $sentenciaSQL="UPDATE publicaciones set titulo='$this->titulo', fechainicio='$this->fechainicio', fechafin='$this->fechafin', descripcion='$this->descripcion', prioridad='$this->prioridad', idgrupo='$this->idgrupo', imagen='$this->imagen' WHERE idpublicacion='$this->idpublicacion'"; 
		$result = $baseDatos->modificarRegistro($sentenciaSQL);
		$response = array();
		if ($result>0) {       
        	$response["success"] = 1;
        	$response["message"] = "Publicación modificada correctamente.";
	    } else {
    	    $response["success"] = 0;
        	$response["message"] = "Oops! Ocurrió un error!!";       
    	}
		return $response;		 
    }//Fin método actualizaDatosPublicacion


	//Método eliminaPublicacion, usado para eliminar una publicación en la BD
    function eliminaPublicacion(){     

	    $baseDatos = new cBaseDatos();


	    $sentenciaSQL="DELETE from publicaciones WHERE idpublicacion='$this->idpublicacion'"; 
		$result = $baseDatos->eliminarRegistro($sentenciaSQL);
	
    	if ($result) {
        
        	$response["success"] = 1;
        	$response["message"] = "Publicación eliminada correctamente.";
    	} else {
       
        	$response["success"] = 0;
        	$response["message"] = "Oops! Ocurrió un error!!";      
    	}

		return $response;
		 
    }//Fin método eliminaPublicacion


	//Método consultaPublicacion, usado para consultar registros de un Publicacion en la BD
    function consultaPublicacion(){     
	    
		$baseDatos = new cBaseDatos();
		
        $sentenciaSQL="SELECT idpublicacion, titulo, fechainicio, fechafin, descripcion, prioridad, idgrupo, imagen "; 
        $sentenciaSQL = $sentenciaSQL . "from publicaciones ";
        $sentenciaSQL = $sentenciaSQL . "WHERE idpublicacion=". $this->idpublicacion;
  
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
		$result = array();
		if ($rs->num_rows > 0){
	    	while($row = $rs->fetch_assoc()){
                $result[]=  $row;
			}
		}
		else{
        
        	$result["error"] = 1;
        	$result["message"] = "La publicación no existe en la BD.";
		
		}

		return $result;
		 
    }//Fin método consultaPublicacion

    
    //Método consultaPublicaciones, usado para consultar registros de todas las pUblicaciones en la BD
    function consultaPublicaciones(){     
        
        session_start();

        $baseDatos = new cBaseDatos();
        
        $sentenciaSQL="SELECT distinct idpublicacion, titulo, fechainicio, fechafin, descripcion ";
        $sentenciaSQL .= "FROM publicaciones ";     
        $sentenciaSQL .= "WHERE idadmin=". $_SESSION['IDAdmin'];
        $sentenciaSQL .= " ORDER BY titulo";

        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array('data' => array());
        if ($rs->num_rows > 0){           
           while($row = $rs->fetch_assoc()){
                $result['data'][] = $row; 

            }
        
        }
        
        return $result;
         
    }//Fin método consultaPublicaciones

    //Método consultaEventosC, usado para consultar registros de todos los eventos en la BD
    function consultaEventosC(){   
        
        session_start();
        
        $baseDatos = new cBaseDatos();
        /*
        $sentenciaSQL="SELECT distinct idpublicacion, titulo, fechainicio, fechafin, descripcion ";
        $sentenciaSQL = $sentenciaSQL . "from publicaciones ";
        $sentenciaSQL = $sentenciaSQL . "where fechainicio != '0' AND IDGrupo=" . $_SESSION['IDGrupo'] . " Order by titulo";    
*/
        $sentenciaSQL = "SELECT DISTINCT p.idpublicacion, p.titulo, p.fechainicio, p.fechafin, p.descripcion FROM publicaciones p 
        LEFT JOIN estudiantes_publicaciones ep 
        ON p.idpublicacion = ep.id_publicacion 
        WHERE ep.id_estudiante =" . $_SESSION['Matricula'] . " AND (ep.eliminada IS NULL OR ep.eliminada = FALSE) 
        AND fechainicio != '0' AND IDGrupo=" . $_SESSION['IDGrupo'];


        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array('data' => array());
        if ($rs->num_rows > 0){           
           while($row = $rs->fetch_assoc()){
                $result['data'][] = $row; 

            }
        
        }
        
        return $result;
         
    }//Fin método consultaEventosC

    function obtenerPublicaciones() {

        $baseDatos = new cBaseDatos();

        $sentenciaSQL = "SELECT a.Nombres, a.ApellidoPaterno, a.ApellidoMaterno, a.rol, a.img, p.Titulo, p.Descripcion, p.Imagen FROM publicaciones AS p INNER JOIN administradores AS a ON a.IDAdmin = p.IDAdmin WHERE p.IDGrupo= ".$_SESSION['IDGrupo']. " ORDER BY IDPublicacion DESC";
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array();
        if ($rs->num_rows > 0) {
          while($row = $rs->fetch_assoc()) {
            array_push($result, $row);
          }
        }
        return $result;
      }

    //Método eliminarEventoC, usado para cambiar de estado una publicación en la BD
    function eliminarEventoC(){     

        session_start();

	    $baseDatos = new cBaseDatos();


	    //$sentenciaSQL="DELETE from publicaciones WHERE idpublicacion='$this->idpublicacion'"; 
        $sentenciaSQL = "UPDATE estudiantes_publicaciones SET eliminada = TRUE WHERE id_publicacion = '$this->idpublicacion' AND id_estudiante =".$_SESSION['Matricula'];
		$result = $baseDatos->modificarRegistro($sentenciaSQL);
	
    	if ($result) {
        
        	$response["success"] = 1;
        	$response["message"] = "Evento desechado correctamente.";
    	} else {
       
        	$response["success"] = 0;
        	$response["message"] = "Oops! Ocurrió un error!!";      
    	}

		return $response;
		 
    }//Fin método eliminarEventoC

} //Fin clase publicaciones

?>
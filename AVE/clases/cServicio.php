<?php

include_once 'cBaseDatos.php';

//Clase servicio
class cServicio {
	
	//Atributos de la clase	
	private $idservicio;
	private $nombre;
	
	//Constructor por default	
    function __construct() {
			$this->idservicio="";
			$this->nombre="";
	}


   //Métodos setters para todas las propiedades		
   function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    //Faltan los demás setters

   //Métodos getters para todas las propiedades
    function getNombre() {
        return $this->nombre;
    }
    //Faltan los demás getters
	
    //Método consultaServicios, usado para consultar registros de todas los servicios en la BD
    function consultaServicios(){     
        
        $baseDatos = new cBaseDatos();
        
        $sentenciaSQL="SELECT * from catalogo_servicios order by nombre";

        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array();
        if ($rs->num_rows > 0){
            while($row = $rs->fetch_assoc()){
                //$result[]=  array_map('utf8_encode', $row);
                $result[]= $row;
            }
        }
        else{
        
            $result["error"] = 1;
            $result["message"] = "Error al ejecutar la consulta en la BD.";
        
        }

        return $result;
         
    }//Fin método consultaGrupos

    

} //Fin clase cServicio



?>
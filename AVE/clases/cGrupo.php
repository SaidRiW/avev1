<?php

include_once 'cBaseDatos.php';

//Clase grupo
class cGrupo {
	
	//Atributos de la clase	
	private $idgrupo;
	private $nombre;
	private $carrera;
	
	//Constructor por default	
    function __construct() {
			$this->idgrupo="";
			$this->nombre="";
			$this->carrera="";
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
	
    //Método consultaGrupos, usado para consultar registros de todas los grupos en la BD
    function consultaGrupos(){     
        
        $baseDatos = new cBaseDatos();
        
        $sentenciaSQL="SELECT * from catalogo_grupos order by nombre";

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

    

} //Fin clase cGrupo



?>
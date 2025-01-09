<?php
	
	class cBaseDatos{
		
		//Atributos o propiedades
		private $DB_USER;
		private $DB_PASSWORD;
		private $DB_DATABASE;
		private $DB_SERVER;
		private $MYSQLI;
		
		//Constructor de la clase
		function __construct(){
			$this->DB_USER = "root";
			$this->DB_PASSWORD = "sosi";
			$this->DB_DATABASE = "ave3";
			$this->DB_SERVER = "localhost"; //127.0.0.1
			
		}//Fin del constructor
				
		//Método para conexión a la BD
		function abrirConexion(){
			$this->MYSQLI = new mysqli($this->DB_SERVER, $this->DB_USER, $this->DB_PASSWORD, $this->DB_DATABASE);
			
			//Conectar y verificar si se llevó a cabo con éxito
			if($this->MYSQLI->connect_errno){
				echo "Falló la conexión: " . $this->MYSQLI->connect_errno . " - " . $this->MYSQLI->connect_error; 
				exit();
			}
		}//Fin abrirConexion
		
		
		//Método para cerrar conexión a la BD
		function cerrarConexion(){
			$this->MYSQLI->close(); 
		}//Fin cerrarConexion
		
		
		//Método para insertar un registro en la BD
		//recibe la sentencia SQL de inserción
		function insertarRegistro($sentenciaSQL){
			$this->abrirConexion();
			//Llamado al método query de la clase mysqli, para ejecutar la sentencia, devuelve false o true
			$result = $this->MYSQLI->query($sentenciaSQL);
			$this->cerrarConexion();
			return $result;
		}//Fin insertarRegistro

		//Método para eliminar un registro en la BD
		//recibe la sentencia SQL de eliminación
		function eliminarRegistro($sentenciaSQL){
			$this->abrirConexion();
			$result = $this->MYSQLI->query($sentenciaSQL);
			$this->cerrarConexion();
			return $result;
		}//Fin eliminarRegistro

		
		//Método para modificar un registro en la BD
		//recibe la sentencia SQL de modificación
		function modificarRegistro($sentenciaSQL){
			$this->abrirConexion();
			$result = $this->MYSQLI->query($sentenciaSQL);
			$modificados = $this->MYSQLI->affected_rows;
			$this->cerrarConexion();
			return $modificados;
		}//Fin modificarRegistro
		
		
		
		//Método para consultar un registro en la BD
		//recibe la sentencia SQL de consulta
		function consultaRegistros($sentenciaSQL){
			$this->abrirConexion();
			//Llamado al método query de la clase mysqli, para ejecutar la sentencia, devuelve mysqli_result 
			//que contiene los datos consultados
			$result = $this->MYSQLI->query($sentenciaSQL);
			$this->cerrarConexion();
			return $result;
		}//Fin consultaRegistros
		

		// Método para obtener el mensaje de error
		/*public function obtenerError() {
			return mysqli_error($this->MYSQLI);
		}*/

		// Método para insertar un registro en la BD y obtener el ID insertado
		function insertarRegistroYObtenerID($sentenciaSQL){
			$this->abrirConexion();
			// Ejecutar la consulta de inserción
			$result = $this->MYSQLI->query($sentenciaSQL);
			
			// Obtener el ID del último registro insertado
			$nuevoId = $this->MYSQLI->insert_id;
			
			$this->cerrarConexion();
	
			// Devolver el ID generado
			return $nuevoId;
		}

	} //Fin de la clase

?>
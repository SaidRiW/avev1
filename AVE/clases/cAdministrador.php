<?php

//Incluir la clase BD
include_once 'cBaseDatos.php';

// Clase usuario
class cAdministrador{
    // Atributos de la clase
    private $IDAdmin;
    private $Nombres;
    private $ApellidoPaterno;
    private $ApellidoMaterno;
    private $CorreoInstitucional;
    private $IDServicio;
    private $password;
    private $img;
    private $rol;
    private $status;

    // Constructor por defecto
    function __construct(){
        $this->IDAdmin = "";
        $this->Nombres = "";
        $this->ApellidoPaterno = "";
        $this->ApellidoMaterno = "";
        $this->CorreoInstitucional = "";
        $this->IDServicio = 0; // Puedes establecer otro valor predeterminado si es necesario
        $this->password = "";
        $this->img = "";
        $this->rol = "";
        $this->status = "";
    }

    // Getters and setters de la clase
    function setIDAdmin($IDAdmin) {
        $this->IDAdmin = $IDAdmin;
    }

    function setNombres($nombres) {
        $this->Nombres = $nombres;
    }

    function setApellidoPaterno($apellido) {
        $this->ApellidoPaterno = $apellido;
    }

    function setApellidoMaterno($apellido) {
        $this->ApellidoMaterno = $apellido;
    }

    function setCorreoInstitucional($CorreoInstitucional) {
        $this->CorreoInstitucional = $CorreoInstitucional;
    }

    function setIDServicio($IDServicio) {
        $this->IDServicio = $IDServicio;
    }

    function setPassword($password) {
        $this->password = MD5($password); // Puede ser necesario aplicar hash o cifrado aquí
    }

    function setImg($img) {
        $this->img = $img;
    }
    
    function setRol($rol) {
        $this->rol = $rol;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getIDAdmin() {
        return $this->IDAdmin;
    }

    function getNombres() {
        return $this->Nombres;
    }

    function getApellidoPaterno() {
        return $this->ApellidoPaterno;
    }

    function getApellidoMaterno() {
        return $this->ApellidoMaterno;
    }

    function getCorreoInstitucional() {
        return $this->CorreoInstitucional;
    }

    function getIDServicio() {
        return $this->IDServicio;
    }

    function getPassword() {
        return $this->password;
    }

    function getImg() {
        return $this->img;
    }
    
    function getRol() {
        return $this->rol;
    }

    function getStatus() {
        return $this->status;
    }

    // Función para iniciar sesión
    function iniciarSesion() {
        $bd = new cBaseDatos();

        // Validar el inicio de sesión
        $comandoSQL = "SELECT * FROM administradores WHERE CorreoInstitucional = '$this->CorreoInstitucional' AND password = '$this->password'";

        // Si el usuario existe en la base de datos
        $resultado = $bd->consultaRegistros($comandoSQL);

        // Si encontró el registro del usuario
        if ($resultado->num_rows > 0) {
            // Inicia la sesión y crea variables de sesión
            session_start();
            $_SESSION['autenticado'] = true;
            $_SESSION['CorreoInstitucional'] = $this->CorreoInstitucional;
            // Aquí se asignan las variables de sesión con los datos del usuario
            $fila = $resultado->fetch_row();
            $_SESSION['IDAdmin'] = $fila[0];
            $_SESSION['img'] = $fila[8];
            $_SESSION['Nombres'] = $fila[1];
            $_SESSION['ApellidoPaterno'] = $fila[2];
            $_SESSION['ApellidoMaterno'] = $fila[3];
            $_SESSION['rol'] = $fila[4];
            $_SESSION['IDServicio'] = $fila[6];

            // Puedes agregar más variables de sesión según tus necesidades, como el rol.

            // Retorna un valor de 1 para indicar que se inició la sesión correctamente
            return 1;
        }
        // En caso de que no se encontró al usuario, retorna 0
        else {
            return 0;
        }
    }

	//Método actualizaFotoPerfil, usado para actualizar la foto de un Usuario en la BD
    function actualizaFotoPerfil(){     

	    $baseDatos = new cBaseDatos();
    	$sentenciaSQL="UPDATE administradores set img='$this->img' WHERE IDAdmin='$this->IDAdmin'"; 
		$result = $baseDatos->modificarRegistro($sentenciaSQL);
		$response = array();


		if ($result>0) {       
        	$response["success"] = 1;
        	$response["message"] = "Foto modificada correctamente.";
	    } else {
       
    	    $response["success"] = 0;
        	$response["message"] = "Oops! Ocurrió un error!!";
       
    	}

		return $response;
		 
    }//Fin método actualizaFotoPerfil   

}

?>
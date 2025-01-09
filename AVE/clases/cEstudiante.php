<?php
// Incluir la clase BD
include_once 'cBaseDatos.php';

// Clase usuario
class cEstudiante{
    // Atributos de la clase
    private $Matricula;
    private $Nombres;
    private $ApellidoPaterno;
    private $ApellidoMaterno;
    private $CorreoInstitucional;
    private $IDGrupo;
    private $password;
    private $img;
    private $rol;
    private $status;

    // Constructor por defecto
    function __construct(){
        $this->Matricula = "";
        $this->Nombres = "";
        $this->ApellidoPaterno = "";
        $this->ApellidoMaterno = "";
        $this->CorreoInstitucional = "";
        $this->IDGrupo = 0; // Puedes establecer otro valor predeterminado si es necesario
        $this->password = "";
        $this->img = "";
        $this->rol = "";
        $this->status = "";
    }

    // Getters and setters de la clase
    function setMatricula($matricula) {
        $this->Matricula = $matricula;
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

    function setIDGrupo($IDGrupo) {
        $this->IDGrupo = $IDGrupo;
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

    function getMatriculaPrimaria() {
        return $this->Matricula;
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

    function getIDGrupoIndice() {
        return $this->IDGrupo;
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
        $comandoSQL = "SELECT * FROM estudiantes WHERE CorreoInstitucional = '$this->CorreoInstitucional' AND password = '$this->password'";

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
            $_SESSION['Matricula'] = $fila[0];
            $_SESSION['img'] = $fila[7];
            $_SESSION['Nombres'] = $fila[1];
            $_SESSION['ApellidoPaterno'] = $fila[2];
            $_SESSION['ApellidoMaterno'] = $fila[3];
            $_SESSION['rol'] = $fila[8];
            $_SESSION['IDGrupo'] = $fila[5];

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
    	$sentenciaSQL="UPDATE estudiantes set img='$this->img' WHERE Matricula='$this->Matricula'"; 
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
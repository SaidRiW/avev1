<?php

	include '../clases/cEstudiante.php';
    include '../clases/cAdministrador.php';

    // Se recibe el correo electrónico del formulario de inicio de sesión
    $correoElectronico = $_POST['correo'];

    // Verificar el patrón del correo electrónico para determinar el tipo de usuario
    $esEstudiante = preg_match('/^[0-9].*@utchetumal.edu.mx$/', $correoElectronico);
	
    if ($esEstudiante) {
        $usuario = new cEstudiante();
    } else {
        $usuario = new cAdministrador();
    }
	
	$resultado = array();
	
	if(isset($_GET['inicia_sesion'])){

        $usuario->setCorreoInstitucional($correoElectronico);
        $usuario->setPassword($_POST['contrasena']);
        
        // Iniciar sesión
        $resultado = $usuario->iniciarSesion();
    }
    
    ob_clean();
	echo json_encode($resultado);	


?>
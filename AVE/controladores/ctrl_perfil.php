<?php
    session_start();

    if($_SESSION['rol']=='Administrativo'||$_SESSION['rol']=='Administrativo'){
        include '../clases/cAdministrador.php';
        $usuario = new cAdministrador();
    }elseif($_SESSION['rol']=='Estudiante'){
        include '../clases/cEstudiante.php';
        $usuario = new cEstudiante();
    }
    
	$result = "";

	//Opción 1 editar una foto perfil de usuario
	if($_GET['opcion']==1){
        if($_SESSION['rol']=='Administrativo'||$_SESSION['rol']=='Administrativo'){
		    $usuario->setIDAdmin($_GET['id_usuario']);
        }elseif($_SESSION['rol']=='Estudiante'){
            $usuario->setMatricula($_GET['id_usuario']);
        }

		if ($_FILES['fImg']['error'] === UPLOAD_ERR_OK) {
			// Obtener información de la imagen
			$nombreImagen = $_FILES['fImg']['name'];
			$tipoImagen = $_FILES['fImg']['type'];
			$tamanioImagen = $_FILES['fImg']['size'];
			$rutaTemporalImagen = $_FILES['fImg']['tmp_name'];
	
			// Ruta de la carpeta donde se guardarán las imágenes
			$rutaCarpetaImagenes = "../images/";
	
			// Generar un nombre único para la imagen para evitar conflictos en el servidor
			$nombreImagenUnico = "../images/" . uniqid('imagen_') . "_" . $nombreImagen;
			//$nombreImagenUnico = uniqid('imagen_') . "_" . $nombreImagen;
	
			// Mover la imagen desde la ruta temporal a la carpeta destino
			$rutaDestinoImagen = $rutaCarpetaImagenes . $nombreImagenUnico;
			move_uploaded_file($rutaTemporalImagen, $rutaDestinoImagen);
	
			// Guardar el nombre de la imagen en la base de datos
			$usuario->setImg($nombreImagenUnico);
		}

		$result = $usuario->actualizaFotoPerfil();      
	}

	echo json_encode($result);	

?>
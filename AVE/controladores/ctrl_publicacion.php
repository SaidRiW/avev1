<?php
	include '../clases/cPublicaciones.php';
	
	$publicacion=new cPublicaciones();
	
	$result = "";
	
	//Opción 1 registrar una publicacion
	if($_GET['opcion']==1){
		$publicacion->setTitulo($_POST['txtTitulo']);
		$publicacion->setFechaInicio($_POST['dateFechaInicioEven']);
		$publicacion->setFechaFin($_POST['dateFechaFinEven']);
		$publicacion->setDescripcion($_POST['txtDescripcion']);
		$publicacion->setPrioridad($_POST['selPrioridad']);
		$publicacion->setIdGrupo($_POST['selGrupo']);

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
			$publicacion->setImagen($nombreImagenUnico);
		}

		$result = $publicacion->guardaPublicacion();      
	}

	//Opción 2 eliminar una publicacion
	if($_GET['opcion']==2){
		$publicacion->setIdPublicacion($_GET['idpublicacion']);	
		$result = $publicacion->eliminaPublicacion();      
	}	

	//Opción 3 editar una publicacion
	if($_GET['opcion']==3){
		$publicacion->setIdPublicacion($_GET['idpublicacion']);
		$publicacion->setTitulo($_POST['txtTituloE']);
		$publicacion->setFechaInicio($_POST['dateFechaInicioEvenE']);
		$publicacion->setFechaFin($_POST['dateFechaFinEvenE']);
		$publicacion->setDescripcion($_POST['txtDescripcionE']);
		$publicacion->setPrioridad($_POST['selPrioridadE']);
		$publicacion->setIdGrupo($_POST['selGrupoE']);

		if ($_FILES['fImgE']['error'] === UPLOAD_ERR_OK) {
			// Obtener información de la imagen
			$nombreImagen = $_FILES['fImgE']['name'];
			$tipoImagen = $_FILES['fImgE']['type'];
			$tamanioImagen = $_FILES['fImgE']['size'];
			$rutaTemporalImagen = $_FILES['fImgE']['tmp_name'];
	
			// Ruta de la carpeta donde se guardarán las imágenes
			$rutaCarpetaImagenes = "../images/";
	
			// Generar un nombre único para la imagen para evitar conflictos en el servidor
			$nombreImagenUnico = uniqid('imagen_') . "_" . $nombreImagen;
	
			// Mover la imagen desde la ruta temporal a la carpeta destino
			$rutaDestinoImagen = $rutaCarpetaImagenes . $nombreImagenUnico;
			move_uploaded_file($rutaTemporalImagen, $rutaDestinoImagen);
	
			// Guardar el nombre de la imagen en la base de datos
			$publicacion->setImagen($nombreImagenUnico);
		}

		$result = $publicacion->actualizaDatosPublicacion();      
	}

	//Opción 4 consultar una publicacion
	if($_GET['opcion']==4){
		$publicacion->setIdPublicacion($_POST['idpublicacion']);
		$result = $publicacion->consultaPublicacion();  
    
	}
	//Opción 5 consultar publicaciones
	if($_GET['opcion']==5){
		$result = $publicacion->consultaPublicaciones();  
    
	}

	//Opción 6 consultar eventos
	if($_GET['opcion']==6){
		$result = $publicacion->consultaEventosC();  
    
	}

	//Opción 2 eliminar una publicacion
	if($_GET['opcion']==7){
		$publicacion->setIdPublicacion($_GET['idpublicacion']);	
		$result = $publicacion->eliminarEventoC();      
	}	

	echo json_encode($result);	

?>
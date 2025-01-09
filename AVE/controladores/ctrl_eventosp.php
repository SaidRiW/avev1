<?php
	include '../clases/cEventosP.php';
	
	$eventop=new cEventosP();

	$result = "";	

	
	//Opción 1 registrar un evento
	if($_GET['opcion']==1){
		$eventop->setTitulo($_POST['txtTitulo']);
		$eventop->setFechaHora($_POST['dateFechaEven']);
		$eventop->setDescripcion($_POST['txtDescripcion']);
		$eventop->setPrioridad($_POST['selPrioridad']);
		$result = $eventop->guardaEvento();       
	}

	//Opción 2 eliminar un evento
	if($_GET['opcion']==2){
		$eventop->setIdEvento($_GET['idevento']);	
		$result = $eventop->eliminaEvento();      
	}

	//Opción 3 editar un evento
	if($_GET['opcion']==3){
		$eventop->setIdEvento($_GET['idevento']);
		$eventop->setTitulo($_POST['txtTituloE']);
		$eventop->setFechaHora($_POST['dateFechaEvenE']);
		$eventop->setDescripcion($_POST['txtDescripcionE']);
		$eventop->setPrioridad($_POST['selPrioridadE']);
		$result = $eventop->actualizaDatosEvento();      
	}

	//Opción 4 consultar un evento
	if($_GET['opcion']==4){
		$eventop->setIdEvento($_POST['idevento']);
		$result = $eventop->consultaEventoP();  
    
	}
	//Opción 5 consultar eventos
	if($_GET['opcion']==5){
		$result = $eventop->consultaEventosP();  
    
	}

	echo json_encode($result);	

?>
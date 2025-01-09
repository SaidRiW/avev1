<?php
	include '../clases/cCitas.php';
	
	$cita=new cCitas();

	$result = "";	

	
	//Opción 1 registrar una cita
	if($_GET['opcion']==1){
		$cita->setMatricula($_POST['txtMatricula']);
		$cita->setFechaHora($_POST['dateFechaCita']);
		$result = $cita->registraCita();       
	}

	//Opción 2 eliminar una cita
	if($_GET['opcion']==2){
		$cita->setIdCita($_GET['idcita']);	
		$result = $cita->eliminaCita();      
	}

	//Opción 3 editar una cita
	if($_GET['opcion']==3){
		$cita->setIdCita($_GET['idcita']);
		$cita->setMatricula($_POST['txtMatriculaE']);
		$cita->setFechaHora($_POST['dateFechaCitaE']);
		$result = $cita->actualizaDatosCita();      
	}

	//Opción 4 consultar una cita
	if($_GET['opcion']==4){
		$cita->setIdCita($_POST['idcita']);
		$result = $cita->consultaCita();  
    
	}
	//Opción 5 consultar citas
	if($_GET['opcion']==5){
		$result = $cita->consultaCitas();  
    
	}

	

	echo json_encode($result);	

?>
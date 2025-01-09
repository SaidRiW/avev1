<?php
	include '../clases/cECitas.php';
	
	$cita=new cECitas();

	$result = "";	

	
	//Opción 1 registrar una cita
	if($_GET['opcion']==1){
		$cita->setIdServicio($_POST['selServicio']);
		$cita->setFechaHora($_POST['dateFechaCita']);
		$result = $cita->registraCita();     
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
<?php
	include '../clases/cServicio.php';
	
	$servicio=new cServicio();
	
	
	$result = "";	
	//Opción 5 consultar servicios
	if($_GET['opcion']==5){

		$result = $servicio->consultaServicios();  
    
	}

	echo json_encode($result);	

?>
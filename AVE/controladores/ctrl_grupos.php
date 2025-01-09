<?php
	include '../clases/cGrupo.php';
	
	$grupo=new cGrupo();
	
	
	$result = "";	
	//Opción 5 consultar grupos
	if($_GET['opcion']==5){

		$result = $grupo->consultaGrupos();  
    
	}

	echo json_encode($result);	

?>
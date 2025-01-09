<?php

	include '../clases/cDashboard.php';
    //Instancia de la clase dashboard
	$cDashboard = new cDashboard();
	
	$resultado="";
	
	if($_GET['opcion']==1){
        $resultado = $cDashboard->estadisticaEventosP();
    }

    if($_GET['opcion']==2){
        $resultado = $cDashboard->estadisticaEventosC();
    }

    if($_GET['opcion']==3){
        $resultado = $cDashboard->estadisticaCitas();
    }

    echo json_encode($resultado);	

?>
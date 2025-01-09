<?php

include_once '../clases/cDashboard.php';

$cDashboard = new cDashboard();

if(isset($_POST['notificationId'])) {
    $notificationId = $_POST['notificationId'];
    $cDashboard->marcarNotificacionLeida($notificationId);
    echo json_encode(['success' => true, 'message' => 'Notificación marcada como leída.']);
} else {
    echo json_encode(['success' => false, 'message' => 'ID de notificación no proporcionado.']);
}

?>

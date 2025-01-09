<?php
include '../clases/cBaseDatos.php'; // Incluye el archivo de la clase cBaseDatos

session_start();

// Crear una instancia de la clase cBaseDatos
$conexion = new cBaseDatos();



//++++++++++++++++++++++++++++++++++

// Obtener el ID del evento desde la solicitud GET
$idEvento = isset($_GET['idEvento']) ? $_GET['idEvento'] : null;

// Si se proporciona un ID de evento, determinar el tipo de evento y obtener los detalles
if ($idEvento !== null) {
    // Determinar el tipo de evento según las tablas disponibles
    $tipo_evento = null;
    
    // Lógica para determinar el tipo de evento según el ID proporcionado
    $sql_check_evento_personales = "SELECT COUNT(*) as count FROM eventos_personales WHERE idevento = $idEvento";
    $resultado_check_evento_personales = $conexion->consultaRegistros($sql_check_evento_personales);
    
    if ($resultado_check_evento_personales) {
        $fila = $resultado_check_evento_personales->fetch_assoc();
        if ($fila['count'] > 0) {
            $tipo_evento = 'Personal';
        }
    }

    $sql_check_evento_comunidad = "SELECT COUNT(*) as count FROM publicaciones WHERE idpublicacion = $idEvento";
    $resultado_check_evento_comunidad = $conexion->consultaRegistros($sql_check_evento_comunidad);

    if ($resultado_check_evento_comunidad) {
        $fila = $resultado_check_evento_comunidad->fetch_assoc();
        if ($fila['count'] > 0) {
            $tipo_evento = 'Comunidad';
        }
    }

    $sql_check_evento_cita = "SELECT COUNT(*) as count FROM citas WHERE idcita = $idEvento";
    $resultado_check_evento_cita = $conexion->consultaRegistros($sql_check_evento_cita);

    if ($resultado_check_evento_cita) {
        $fila = $resultado_check_evento_cita->fetch_assoc();
        if ($fila['count'] > 0) {
            $tipo_evento = 'Cita';
        }
    }

    // Una vez que se determina el tipo de evento
    if ($tipo_evento !== null) {
        // Obtener detalles específicos del evento según el tipo
        $sql_detalle_evento = "";

        // Lógica para definir la consulta según el tipo de evento
        switch ($tipo_evento) {
            case 'Personal':
                $sql_detalle_evento = "SELECT titulo, fecha_hora as fecha_inicio, descripcion FROM eventos_personales WHERE idevento = $idEvento";
                break;
            case 'Comunidad':
                $sql_detalle_evento = "SELECT titulo, fechainicio as fecha_inicio, fechafin as fecha_fin, descripcion FROM publicaciones WHERE idpublicacion = $idEvento";
                break;
            case 'Cita':
                //$sql_detalle_evento = "SELECT fecha_hora as fecha_inicio FROM citas WHERE idcita = $idEvento";
                $sql_detalle_evento="SELECT distinct c.idcita, c.fecha_hora as fecha_inicio, CONCAT(a.nombres, ' ', a.apellidopaterno, ' ', a.apellidomaterno) AS nombre_admin, s.nombre as servicio ";
                $sql_detalle_evento = $sql_detalle_evento . "from citas c ";   
                $sql_detalle_evento = $sql_detalle_evento . "INNER join catalogo_servicios s on c.idservicio = s.idservicio ";
                $sql_detalle_evento = $sql_detalle_evento . "INNER join administradores a on c.idadmin = a.idadmin ";
                $sql_detalle_evento = $sql_detalle_evento . "Order by nombre_admin";
                break;
        }

        // Realizar la consulta para obtener detalles del evento
        $resultado_detalle_evento = $conexion->consultaRegistros($sql_detalle_evento);

        if ($resultado_detalle_evento) {
            $data = $resultado_detalle_evento->fetch_assoc();

            if ($data) {
                $data['extendedProps'] = array('tipo' => $tipo_evento);
                // Convertir los detalles del evento a formato JSON y enviarlos al cliente
                echo json_encode($data);
                exit(); // Salir para evitar la ejecución del código restante
            }
        }
    }
}

//+++++++++++++++++++++++++++++++++++++++++++++++

// Realizar la consulta para obtener los eventos de la tabla eventos_personales
$sql_eventos1 = 'SELECT idevento as id, titulo, fecha_hora as fecha_inicio, color FROM eventos_personales WHERE matricula='. $_SESSION['Matricula'];
$resultado_eventos1 = $conexion->consultaRegistros($sql_eventos1);

// Realizar la consulta para obtener los eventos de la tabla publicaciones
$sql_eventos2 = "SELECT p.idpublicacion as id, titulo, p.fechainicio as fecha_inicio, p.fechafin as fecha_fin, p.color FROM publicaciones p 
    LEFT JOIN estudiantes_publicaciones ep 
    ON p.idpublicacion = ep.id_publicacion 
    WHERE ep.id_estudiante =" . $_SESSION['Matricula'] . " AND (ep.eliminada IS NULL OR ep.eliminada = FALSE) 
    AND fechainicio != 0 AND IDGrupo=" . $_SESSION['IDGrupo'];
$resultado_eventos2 = $conexion->consultaRegistros($sql_eventos2);

// Realizar la consulta para obtener los eventos de la tabla citas
$sql_eventos3 = 'SELECT c.IDCita as id, s.nombre as titulo, c.fecha_hora as fecha_inicio FROM citas as c INNER JOIN catalogo_servicios as s on c.IDServicio = s.IDServicio WHERE matricula='. $_SESSION['Matricula'];
$resultado_eventos3 = $conexion->consultaRegistros($sql_eventos3);

// Crear un array para almacenar los eventos combinados
$eventos = array();

// Función para agregar eventos al array de eventos
function agregarEventos($resultado, $conFechaFin = true, $conColor = true) {
    global $eventos;
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $evento = array(
                'id' => $fila['id'],
                'title' => $fila['titulo'],
                'start' => $fila['fecha_inicio'],
            );
            if ($conFechaFin && isset($fila['fecha_fin'])) {
                $evento['end'] = $fila['fecha_fin'];
            }
            if ($conColor && isset($fila['color'])) {
                $evento['color'] = $fila['color'];
            }

            // Agregar el evento al array de eventos
            $eventos[] = $evento;
        }
    }
}

// Agregar eventos de la tabla eventos_personales al array de eventos
agregarEventos($resultado_eventos1, false); // Se establece en falso para indicar que no hay fecha de finalización

// Agregar eventos de la tabla publicaciones al array de eventos
agregarEventos($resultado_eventos2);

// Agregar eventos de la tabla citas al array de eventos
agregarEventos($resultado_eventos3);

// Convertir el array de eventos a formato JSON y enviarlo al cliente
echo json_encode($eventos);
?>

<?php
include '../clases/cBaseDatos.php'; // Incluye el archivo de la clase cBaseDatos

// Crear una instancia de la clase cBaseDatos
$conexion = new cBaseDatos();


//++++++++++++++++++++++++++++++++++

// Obtener el ID del evento desde la solicitud GET
$idEvento = isset($_GET['idEvento']) ? $_GET['idEvento'] : null;

// Si se proporciona un ID de evento, determinar el tipo de evento y obtener los detalles
if ($idEvento !== null) {
    // Determinar el tipo de evento según las tablas disponibles
    $tipo_evento = null;

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
            case 'Cita':
                //$sql_detalle_evento = "SELECT fecha_hora as fecha_inicio FROM citas WHERE idcita = $idEvento";
                $sql_detalle_evento="SELECT distinct c.idcita, c.fecha_hora as fecha_inicio, CONCAT(e.nombres, ' ', e.apellidopaterno, ' ', e.apellidomaterno) AS nombre_estudiante, g.nombre as grupo ";
                $sql_detalle_evento = $sql_detalle_evento . "from citas c ";   
                $sql_detalle_evento = $sql_detalle_evento . "INNER join catalogo_grupos g on c.idgrupo = g.idgrupo ";
                $sql_detalle_evento = $sql_detalle_evento . "INNER join estudiantes e on c.matricula = e.matricula ";
                $sql_detalle_evento = $sql_detalle_evento . "Order by nombre_estudiante";
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


// Realizar la consulta para obtener los eventos de la tabla citas
$sql_eventos3 = "SELECT c.IDCita as id, CONCAT(e.nombres, ' ', e.apellidopaterno) as titulo, c.fecha_hora as fecha_inicio FROM citas as c INNER JOIN estudiantes as e on c.matricula = e.matricula";
$resultado_eventos3 = $conexion->consultaRegistros($sql_eventos3);

// Crear un array para almacenar los eventos combinados
$eventos = array();

// Función para agregar eventos al array de eventos
function agregarEventos($resultado, $conFechaFin = true) {
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

            // Agregar el evento al array de eventos
            $eventos[] = $evento;
        }
    }
}

// Agregar eventos de la tabla citas al array de eventos
agregarEventos($resultado_eventos3);

// Convertir el array de eventos a formato JSON y enviarlo al cliente
echo json_encode($eventos);
?>

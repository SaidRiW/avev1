<?php

//Incluir la clase BD
include_once 'cBaseDatos.php';

//Clase dashboard
class cDashboard{

    //Atributos de la clase

    //Constructor por default
    function __construc(){

    }


    //Funcion para regresar la estadística de eventos personales
    function estadisticaEventosP(){

        session_start();

        $bd = new cBaseDatos();

        $comandoSQL = "SELECT * FROM eventos_personales WHERE matricula=".$_SESSION['Matricula'];
        
        $resultado = $bd->consultaRegistros($comandoSQL);
        
        $response = array();

     
        $response["success"] = 1;
        $response["count"] = $resultado->num_rows;
   

        return $response;
        
    }    

    //Funcion para regresar la estadística de eventos de comunidad
    function estadisticaEventosC(){

        session_start();

        $bd = new cBaseDatos();

        //$comandoSQL = "SELECT * FROM publicaciones WHERE fechainicio != '0' AND IDGrupo=". $_SESSION['IDGrupo'];

        $comandoSQL = "SELECT * FROM publicaciones p 
        LEFT JOIN estudiantes_publicaciones ep 
        ON p.idpublicacion = ep.id_publicacion 
        WHERE ep.id_estudiante =" . $_SESSION['Matricula'] . " AND (ep.eliminada IS NULL OR ep.eliminada = FALSE) 
        AND fechainicio != '0' AND IDGrupo=" . $_SESSION['IDGrupo'];

        
        $resultado = $bd->consultaRegistros($comandoSQL);
        
        $response = array();

     
        $response["success"] = 1;
        $response["count"] = $resultado->num_rows;
   

        return $response;
        
    }

     //Funcion para regresar la estadística de citas
     function estadisticaCitas(){

        session_start();

        $bd = new cBaseDatos();

        $comandoSQL = "SELECT * FROM citas WHERE matricula=".$_SESSION['Matricula'];
        
        $resultado = $bd->consultaRegistros($comandoSQL);
        
        $response = array();

     
        $response["success"] = 1;
        $response["count"] = $resultado->num_rows;
   

        return $response;
        
    }

    //Función para regresar notificaciones de citas
    function notificacionCitasA(){

        $baseDatos = new cBaseDatos();

        $sentenciaSQL = "SELECT * FROM notificaciones WHERE Usuario2= " .$_SESSION['IDAdmin']. " AND Leido = '0' ORDER BY fecha DESC";
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array();
        if ($rs->num_rows > 0) {
          while($row = $rs->fetch_assoc()) {
            array_push($result, $row);
          }
        }
        return $result;

    }

    //Función para extraer datos del estudiante
    function extraerEstudiante($estudiante){

        $baseDatos = new cBaseDatos();

        $sentenciaSQL = "SELECT * FROM estudiantes WHERE Matricula='$estudiante'";
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array();
        if ($rs->num_rows > 0) {
          while($row = $rs->fetch_assoc()) {
            array_push($result, $row);
          }
        }
        return $result;

    }

    //Función para regresar notificaciones de citas
    function notificacionCitasE(){

        $baseDatos = new cBaseDatos();

        $sentenciaSQL = "SELECT * FROM notificaciones WHERE Usuario2= " .$_SESSION['Matricula']. " AND Leido = '0' AND Tipo = '(Cita)' ORDER BY fecha DESC";
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array();
        if ($rs->num_rows > 0) {
          while($row = $rs->fetch_assoc()) {
            array_push($result, $row);
          }
        }
        return $result;

    }

    //Función para extraer datos del administrador
    function extraerAdmin($admin){

        $baseDatos = new cBaseDatos();

        $sentenciaSQL = "SELECT * FROM administradores WHERE IDAdmin='$admin'";
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array();
        if ($rs->num_rows > 0) {
          while($row = $rs->fetch_assoc()) {
            array_push($result, $row);
          }
        }
        return $result;

    }

    //Función para regresar notificaciones de citas
    function notificacionCitasCancelE(){

        $baseDatos = new cBaseDatos();

        $sentenciaSQL = "SELECT * FROM notificaciones WHERE Usuario2= " .$_SESSION['Matricula']. " AND Leido = '0' AND Tipo = '(Cita cancelada)' ORDER BY fecha DESC";
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array();
        if ($rs->num_rows > 0) {
          while($row = $rs->fetch_assoc()) {
            array_push($result, $row);
          }
        }
        return $result;

    }

    //Función para regresar notificaciones de citas
    function notificacionPublicacionesE(){

        $baseDatos = new cBaseDatos();

        $sentenciaSQL = "SELECT * FROM notificaciones WHERE Usuario2= " .$_SESSION['Matricula']. " AND Leido = '0' AND Tipo = '(Publicación)' ORDER BY fecha DESC";
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array();
        if ($rs->num_rows > 0) {
          while($row = $rs->fetch_assoc()) {
            array_push($result, $row);
          }
        }
        return $result;

    }

    // Método para marcar una notificación como leída
    function marcarNotificacionLeida($idNotificacion) {
      $baseDatos = new cBaseDatos();
      $sentenciaSQL = "UPDATE notificaciones SET Leido = '1' WHERE IDNotificacion = $idNotificacion";
      $baseDatos->modificarRegistro($sentenciaSQL);
    }

}
?>
<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
    // Verificar el rol del usuario
    if ($_SESSION['rol'] === 'Administrativo') {
        // Redirigir al usuario con rol de "admin" a la página principal del administrativo
        header("Location: ../vistas/a2calendario.php");
        exit();
    } elseif ($_SESSION['rol'] === 'Docente') {
        // Redirigir al usuario con rol de "usuario_normal" a la página principal del estudiante
        header("Location: ../vistas/a1comunidad.php");
        exit();
    } else {
        // Redirigir a una página de error si el rol no coincide con ninguna página principal
        header("Location: ../vistas/ecalendario.php");
        exit();
    }
} else {
    // Si el usuario no está autenticado, redirigirlo al formulario de inicio de sesión
    header("Location: ../index.php");
    exit();
}
?>

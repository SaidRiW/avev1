<?php
  //Cargar sesion del usuario logueado
  session_start();
	if(!isset($_SESSION['autenticado'])){//Si no hay un usuario logueado, regresar al logueo**
    header("Location: ../index.php");

  }
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AVE | Agendar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../plugins/fullcalendar/main.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../dist/img/logo.png">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

<!-- Navbar -->
<?php 
  include('encabezado.php')
?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php 
  include('menu_lateral.php')
?>
<!--  /.Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Agendar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" id=btnAgendarCita class="btn btn-primary mr-2">Agendar cita</button>
              <button type="button" id=btnAgendarEvento class="btn btn-primary mr-2">Agendar evento</button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body p-1">
            <!-- THE CALENDAR -->
              <div id="calendar"></div>
          </div>
          <!-- /.card-body -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- FORMULARIOS MODALES-->
    <!-- AGENDAR CITA -->
    <div class="modal fade" tabindex="-1" id="registrarCita" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
          <form id="frmNuevaCita">
              <div class="card-body">
                <div class="form-group">
                        <label for="selServicio">Servicio</label>
                        <select class="form-control" id="selServicio" name="selServicio" required>
                        </select>
                </div>
                <div class="form-group">
                    <label for="dateFechaCita">Fecha y hora</label>
                      <div class="input-group date">
                        <input type="datetime-local" id="dateFechaCita" name="dateFechaCita" class="form-control"/>
                      </div>
                </div>
              </div>
            <!-- /.card-body -->
          </form>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-center mb-4">
              <button type="button" class="btn btn-primary mr-2 w-25" id="btnGuardarCita">Agendar</button>
              <button type="button" class="btn btn-outline-danger w-25" id="btnCancelarCita">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
		
    <!-- FIN MODAL AGENDAR CITA -->

    <!-- AGENDAR EVENTO -->
    <div class="modal fade" tabindex="-1" id="registrarEvento" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
          <form id="frmNuevoEvento">
              <div class="card-body">
                <div class="form-group">
                  <label for="txtTitulo">Título</label>
                  <input type="text" class="form-control" id="txtTitulo" name="txtTitulo">
                </div>
                <div class="form-group">
                    <label for="dateFechaEven">Fecha del evento</label>
                      <div class="input-group date">
                        <input type="datetime-local" id="dateFechaEven" name="dateFechaEven" class="form-control""/>
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="txtDescripcion">Descripción</label>
                    <textarea id="txtDescripcion" name="txtDescripcion" class="form-control" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                        <label for="selPrioridad">Prioridad</label>
                        <select class="form-control" id="selPrioridad" name="selPrioridad">
                          <option value="ALTA">ALTA</option>
                          <option value="MEDIA">MEDIA</option>
                          <option value="BAJA">BAJA</option>
                        </select>
                  </div>
              </div>
                <!-- /.card-body -->
          </form>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-center mb-4">
              <button type="button" class="btn btn-primary mr-2 w-25" id="btnGuardarEvento">Agendar</button>
              <button type="button" class="btn btn-outline-danger w-25" id="btnCancelarEvento">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN MODAL AGENDAR EVENTO -->
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/fullcalendar/main.js"></script>
<!-- Page specific script -->
<script src="../js/ecalendario.js"></script>
<script src="../plugins/fullcalendar/locales/es.js"></script> <!--Idioma español Fullcalendar-->

<script src="../js/eagendar.js"></script>
<!-- Sweet Alert -->
<script src="../dist/js/sweetalert2.all.min.js"></script>

<script>
    function fechaActual() {
      var now = new Date();
      var year = now.getFullYear();
      var month = (now.getMonth() + 1).toString().padStart(2, '0');
      var day = now.getDate().toString().padStart(2, '0');
      var hours = now.getHours().toString().padStart(2, '0');
      var minutes = now.getMinutes().toString().padStart(2, '0');
      return `${year}-${month}-${day}T${hours}:${minutes}`;
    }
</script>
</body>
</html>
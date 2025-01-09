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
  <title>AVE | Citas</title>

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
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../dist/img/logo.png">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

<!-- Navbar -->
<?php 
  include('aencabezado.php')
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Citas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" id=btnAgendarCita class="btn btn-primary mr-2">Agendar cita</button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de citas agendadas </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablaCitas" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  <th>Fecha/Hora</th>
                  <th>Estudiante</th>
                  <th>Grupo</th>
                  <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
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
                  <label for="txtMatricula">Matrícula del alumno</label>
                  <input type="text" class="form-control" id="txtMatricula" name="txtMatricula">
                </div>
                <div class="form-group">
                    <label for="dateFechaCita">Fecha y hora</label>
                      <div class="input-group date">
                        <input type="datetime-local" id="dateFechaCita" name="dateFechaCita" class="form-control""/>
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
    <!-- EDITAR CITA -->
    <div class="modal fade" tabindex="-1" id="editarCt" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
          <form id="frmEditarCt">
              <div class="card-body">
              <div class="form-group">
                <!--
                  <label for="txtIdCitaE">ID</label>
                -->
                  <input type="hidden" class="form-control" id="txtIdCitaE" name="txtIdCitaE" readonly>
              </div>
                <div class="form-group">
                  <label for="txtMatriculaE">Matrícula del alumno</label>
                  <input type="text" class="form-control" id="txtMatriculaE" name="txtMatriculaE" readonly>
                </div>
                <div class="form-group">
                    <label for="dateFechaCitaE">Fecha y hora</label>
                      <div class="input-group date">
                        <input type="datetime-local" id="dateFechaCitaE" name="dateFechaCitaE" class="form-control""/>
                      </div>
                </div>
              </div>
                <!-- /.card-body -->
          </form>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-center mb-4">
              <button type="button" class="btn btn-primary mr-2 w-25" id="btnGuardarCitaE">Agendar</button>
              <button type="button" class="btn btn-outline-danger w-25" id="btnCancelarCitaE">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
		
    <!-- FIN MODAL EDITAR CITA -->

    <!-- VER CITA -->
    <div class="modal fade" tabindex="-1" id="verCt" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
          <form id="frmVerCt">
              <div class="card-body">
              <div class="form-group">
                  <label for="txtIdCitaV">ID</label>
                  <input type="text" class="form-control" id="txtIdCitaV" name="txtIdCitaV" readonly>
              </div>
                <div class="form-group">
                  <label for="txtMatriculaV">Matrícula del alumno</label>
                  <input type="text" class="form-control" id="txtMatriculaV" name="txtMatriculaV" readonly>
                </div>
                <div class="form-group">
                    <label for="dateFechaCitaV">Fecha y hora</label>
                      <div class="input-group date">
                        <input type="datetime-local" id="dateFechaCitaV" name="dateFechaCitaV" class="form-control" readonly/>
                      </div>
                </div>
              </div>
                <!-- /.card-body -->
          </form>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-center mb-4">
              <button type="button" class="btn btn-outline-danger w-25" id="btnCerrarCitaV">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
		
    <!-- FIN MODAL VER CITA -->
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
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
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

<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Funciones JS -->
<script src="../js/a2citas.js"></script>
<!-- Sweet Alert -->
<script src="../dist/js/sweetalert2.all.min.js"></script>
</body>
</html>
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
  <title>AVE | Eventos</title>

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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Eventos personales</h1>
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
                <h3 class="card-title">Listado de eventos personales </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablaEvnP" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  <th>Título</th>
                  <th>Fecha</th>
                  <th>Descripción</th>
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Eventos de comunidad</h1>
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
                <h3 class="card-title">Listado de eventos de comunidad</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablaEventosC" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  <th>Título</th>
                  <th>Fecha inicial</th>
                  <th>Fecha final</th>
                  <th>Descripción</th>
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

    <!-- EDITAR EVENTO PERSONAL -->
    <div class="modal fade" tabindex="-1" id="editarEvento" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
          <form id="frmEditarEvento">
              <div class="card-body">
              <div class="form-group">
                <!--
                  <label for="txtIdEventoE">ID</label>
                -->
                  <input type="hidden" class="form-control" id="txtIdEventoE" name="txtIdEventoE" readonly>
                </div>
                <div class="form-group">
                  <label for="txtTituloE">Título</label>
                  <input type="text" class="form-control" id="txtTituloE" name="txtTituloE">
                </div>
                <div class="form-group">
                    <label for="dateFechaEvenE">Fecha del evento</label>
                      <div class="input-group date">
                        <input type="datetime-local" id="dateFechaEvenE" name="dateFechaEvenE" class="form-control""/>
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="txtDescripcionE">Descripción</label>
                    <textarea id="txtDescripcionE" name="txtDescripcionE" class="form-control" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                        <label for="selPrioridadE">Prioridad</label>
                        <select class="form-control" id="selPrioridadE" name="selPrioridadE">
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
              <button type="button" class="btn btn-primary mr-2 w-25" id="btnGuardarEventoE">Guardar </button>
              <button type="button" class="btn btn-outline-danger w-25" id="btnCancelarEventoE">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN MODAL EDITAR EVENTO PERSONAL -->

    <!-- VER EVENTO PERSONAL -->
    <div class="modal fade" tabindex="-1" id="verEvento" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
          <form id="frmVerEvento">
              <div class="card-body">
                <div class="form-group">
                  <label for="txtTituloV">Título</label>
                  <input type="text" class="form-control" id="txtTituloV" name="txtTituloV" readonly>
                </div>
                  <div class="form-group">
                    <label for="dateFechaEvenV">Fecha del evento</label>
                      <div class="input-group date">
                        <input type="datetime-local" id="dateFechaEvenV" name="dateFechaEvenV" class="form-control" readonly/>
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="txtDescripcionV">Descripción</label>
                    <textarea id="txtDescripcionV" name="txtDescripcionV" class="form-control" rows="3" readonly></textarea>
                  </div>
                  <div class="form-group">
                        <label for="selPrioridadV">Prioridad</label>
                        <select class="form-control" id="selPrioridadV" name="selPrioridadV" readonly>
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
              <button type="button" class="btn btn-outline-danger w-25" id="btnCerrarEventoV">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN MODAL VER EVENTO PERSONAL -->

      <!-- VER EVENTO DE COMUNIDAD  -->
      <div class="modal fade" tabindex="-1" id="verPc" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <form id="frmVerPc">
              <div class="card-body">
                <div class="form-group">
                  <label for="txtTituloCV">Título</label>
                  <input type="text" class="form-control" id="txtTituloCV" name="txtTituloCV" readonly maxlength="60">
                </div>
                <div class="form-group">
                  <label for="dateFechaInicioEvenV">Fecha inicial del evento</label>
                    <div class="input-group date">
                      <input type="datetime-local" id="dateFechaInicioEvenV" name="dateFechaInicioEvenV" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group">
                  <label for="dateFechaFinEvenV">Fecha final del evento</label>
                    <div class="input-group date">
                      <input type="datetime-local" id="dateFechaFinEvenV" name="dateFechaFinEvenV" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                  <label for="txtDescripcionCV">Descripción</label>
                  <textarea class="form-control" id="txtDescripcionCV" name="txtDescripcionCV" readonly></textarea>
                </div>
                
                <div class="form-group">
                  <label for="selPrioridadV">Prioridad</label>
                  <select class="form-control" id="selPrioridadV" name="selPrioridadV" readonly>
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
              <button type="button" class="btn btn-outline-danger w-25" id="btnCerrarPublicacionV">Cerrar</button>
          </div>
        </div>
      </div>
    </div>	
  <!-- FIN MODAL VER EVENTO PERSONAL -->
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
<script src="../js/eeventosc.js"></script>
<script src="../js/eeventosp.js"></script>
<!-- Sweet Alert -->
<script src="../dist/js/sweetalert2.all.min.js"></script>
</body>
</html>
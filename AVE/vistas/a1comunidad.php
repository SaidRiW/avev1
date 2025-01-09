<?php
  //Cargar sesion del usuario logueado
  session_start();
	if(!isset($_SESSION['autenticado'])){//Si no hay un usuario logueado, regresar al logueo**
    header("Location: ../index.php");

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AVE | Comunidad</title>

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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Publicaciones</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" id="btnNuevaPublicacion" class="btn btn-primary mr-2">Crear publicación</button>
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
              <div class="card-header">
                <h3 class="card-title">Listado de publicaciones</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablaPublicaciones" class="table table-bordered table-hover">
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
      <!-- CREAR PUBLICACION  -->
    <div class="modal fade" tabindex="-1" id="registrarPublicacion" role="dialog" enctype="multipart/form-data">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <form id="frmNuevaPublicacion">
              <div class="card-body">
                <div class="form-group">
                  <label for="txtTitulo">Título</label>
                  <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" required maxlength="60">
                </div>
                <div class="form-group">
                    <label for="dateFechaInicioEven">Fecha inicial del evento</label>
                      <div class="input-group date">
                        <input type="datetime-local" id="dateFechaInicioEven" name="dateFechaInicioEven" class="form-control""/>
                      </div>
                </div>
                  <div class="form-group">
                    <label for="dateFechaFinEven">Fecha final del evento</label>
                      <div class="input-group date">
                        <input type="datetime-local" id="dateFechaFinEven" name="dateFechaFinEven" class="form-control""/>
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
                  <div class="form-group">
                        <label for="selGrupo">Grupo a enviar</label>
                        <select class="form-control" id="selGrupo" name="selGrupo" required>
                        </select>
                  </div>
                  <div class="form-group">
                      <label for="fImg">Adjuntar imagen</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="fImg" name="fImg" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                        <label class="custom-file-label" for="fImg"></label>
                      </div>
                  </div>
              </div>
                <!-- /.card-body -->
            </form>
            <div class="d-grid gap-2 d-md-flex justify-content-center mb-4">
              <button type="button" class="btn btn-primary mr-2 w-25" id="btnGuardarPublicacion">Crear </button>
              <button type="button" class="btn btn-outline-danger w-25" id="btnCancelarPublicacion">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
    </div>	
    <!-- FIN MODAL CREAR PUBLICACION -->

    <!-- EDITAR PUBLICACION  -->
    <div class="modal fade" tabindex="-1" id="editarPc" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <form id="frmEditarPc">
              <div class="card-body">
              <div class="form-group">
                  <label for="txtIdPublicacionE">ID</label>
                  <input type="text" class="form-control" id="txtIdPublicacionE" name="txtIdPublicacionE" readonly>
              </div>
                <div class="form-group">
                  <label for="txtTituloE">Título</label>
                  <input type="text" class="form-control" id="txtTituloE" name="txtTituloE" required maxlength="60">
                </div>
                <div class="form-group">
                  <label for="dateFechaInicioEvenE">Fecha inicial del evento</label>
                    <div class="input-group date">
                      <input type="datetime-local" id="dateFechaInicioEvenE" name="dateFechaInicioEvenE" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                  <label for="dateFechaFinEvenE">Fecha final del evento</label>
                    <div class="input-group date">
                      <input type="datetime-local" id="dateFechaFinEvenE" name="dateFechaFinEvenE" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                  <label for="txtDescripcionE">Descripción</label>
                  <textarea class="form-control" id="txtDescripcionE" name="txtDescripcionE"></textarea>
                </div>
                
                <div class="form-group">
                  <label for="selPrioridadE">Prioridad</label>
                  <select class="form-control" id="selPrioridadE" name="selPrioridadE">
                    <option value="ALTA">ALTA</option>
                    <option value="MEDIA">MEDIA</option>
                    <option value="BAJA">BAJA</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="selGrupoE">Grupo a enviar</label>
                    <select class="form-control" id="selGrupoE" name="selGrupoE" required>
                    </select>
                </div>
                <div class="form-group">
                  <label for="fImgE">Adjuntar imagen</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="fImgE" name="fImgE" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                      <label class="custom-file-label" for="fImgE"></label>
                  </div>
                </div>
              </div>
                <!-- /.card-body -->
            </form>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-center mb-4">
              <button type="button" class="btn btn-primary mr-2 w-25" id="btnGuardarPublicacionE">Guardar </button>
              <button type="button" class="btn btn-outline-danger w-25" id="btnCancelarPublicacionE">Cancelar</button>
          </div>
        </div>
      </div>
    </div>	
    <!-- FIN MODAL EDITAR PUBLICACION -->
      <!-- VER PUBLICACION  -->
      <div class="modal fade" tabindex="-1" id="verPc" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <form id="frmVerPc">
              <div class="card-body">
              <div class="form-group">
                  <label for="txtIdPublicacionV">ID</label>
                  <input type="text" class="form-control" id="txtIdPublicacionV" name="txtIdPublicacionV" readonly>
              </div>
                <div class="form-group">
                  <label for="txtTituloE">Título</label>
                  <input type="text" class="form-control" id="txtTituloV" name="txtTituloV" readonly maxlength="60">
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
                  <label for="txtDescripcionV">Descripción</label>
                  <textarea class="form-control" id="txtDescripcionV" name="txtDescripcionV" readonly></textarea>
                </div>
                
                <div class="form-group">
                  <label for="selPrioridadV">Prioridad</label>
                  <select class="form-control" id="selPrioridadV" name="selPrioridadV" readonly>
                    <option value="ALTA">ALTA</option>
                    <option value="MEDIA">MEDIA</option>
                    <option value="BAJA">BAJA</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="selGrupoV">Grupo a enviar</label>
                    <select class="form-control" id="selGrupoV" name="selGrupoV" readonly>
                    </select>
                </div>
                <div class="form-group">
                  <label for="fImgV">Adjuntar imagen</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="fImgV" name="fImgV" accept="image/x-png,image/gif,image/jpeg,image/jpg" readonly>
                      <label class="custom-file-label" for="fImgV"></label>
                  </div>
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
  <!-- FIN MODAL VER PUBLICACION -->
  <!-- /.content-wrapper -->
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
<script src="../js/a1comunidad.js"></script>
<!-- Sweet Alert -->
<script src="../dist/js/sweetalert2.all.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- File -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
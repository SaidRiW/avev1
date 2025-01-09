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
  <title>AVE | Perfil</title>

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
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../dist/img/logo.png">
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

<!-- Navbar -->
<?php 
if($_SESSION['rol']=='Estudiante'){
  include('encabezado.php');
}elseif($_SESSION['rol']=='Administrativo'||$_SESSION['rol']=='Docente'){
  include('aencabezado.php');
}
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
            <h1 class="m-0">Perfil</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Profile Image -->
            <div class="card">
              <div class="card-body">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo $_SESSION['img'];?>"
                       alt="User profile picture"><br>
                       <?php
                       if ($_SESSION["rol"] == "Estudiante") {
                        echo "<button type='button' id='btnCambiarFotoPerfil' class='btn btn-sm btn-primary'><i class='nav-icon fas fa-camera'></i></button>";
                       }
                       elseif($_SESSION['rol']=='Administrativo'||$_SESSION['rol']=='Docente'){
                        echo "<button type='button' id='btnCambiarFotoPerfil' class='btn btn-sm btn-primary'><i class='nav-icon fas fa-camera'></i></button>";
                       }
                       ?>
                </div>
                <div class="row">
                <div class="col-2"></div>

                  <div class="col-8">
                  <h3 class="profile-username text-center"><?php echo $_SESSION['rol'];?></h3><br>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Nombre</b> <p class="float-right"><?php echo $_SESSION['Nombres'], " ", $_SESSION['ApellidoPaterno'], " ", $_SESSION['ApellidoMaterno'];?> </p>
                      </li>
                      <li class="list-group-item">
                        <b>Correo institucional</b> <p class="float-right"><?php echo $_SESSION['CorreoInstitucional'];?></p>
                      </li>
                      <?php
                      if($_SESSION['rol'] == 'Estudiante'){
                      ?>
                      <li class="list-group-item">
                        <b>Matricula</b> <p class="float-right"><?php echo $_SESSION['Matricula'];?></p>
                      </li>
                      <!--
                      <li class="list-group-item">
                        <b>Grupo</b> <p class="float-right"><?php echo $_SESSION['IDGrupo'];?></p>
                      </li>
                      <li class="list-group-item">
                        <b>Carrera</b> <p class="float-right"><?php echo $_SESSION['CorreoInstitucional'];?></p>
                      </li>
                      -->
                      <?php
                      }
                      ?>
                    </ul>
                  </div>
                  <div class="col-2"></div>
                </div>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- ./wrapper -->

    <!-- CAMBIAR PERFIL  -->
    <div class="modal fade" tabindex="-1" id="cambiarFotoPerfil" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <form id="frmCambiaFotoPerfil">
              <div class="card-body">
                <div class="form-group">
                  <label for="fImg">Adjuntar foto de  perfil</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="fImg" name="fImg" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                      <label class="custom-file-label" for="fImg"></label>
                  </div>
                </div>
              </div>
                <!-- /.card-body -->
            </form>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-center mb-4">
              <button type="button" class="btn btn-primary mr-2 w-25" id="btnGuardarFotoPerfil">Guardar </button>
              <button type="button" class="btn btn-outline-danger w-25" id="btnCancelarFotoPerfil">Cancelar</button>
          </div>
        </div>
      </div>
    </div>	
    <!-- FIN MODAL CAMBIAR PERFIL -->
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
<!-- Sweet Alert -->
<script src="../dist/js/sweetalert2.all.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!--File-->
<script>
$(function () {
  bsCustomFileInput.init();
})
</script>
<!-- Funciones JS -->
<script>
  <?php
  $idUsuario = null;

  if ($_SESSION['rol'] === 'Administrativo' || $_SESSION['rol'] === 'Docente') {
    $idUsuario = $_SESSION['IDAdmin'];
  } elseif ($_SESSION['rol'] === 'Estudiante') {
    $idUsuario = $_SESSION['Matricula'];
  }
  ?>

  var idUsuario = <?php echo json_encode($idUsuario); ?>;

</script>

<script src="../js/perfil.js"></script>
</body>
</html>
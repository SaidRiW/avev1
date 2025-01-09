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
  <title>AVE | Chat</title>

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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-2">
              <div class="card">
                <div class="card-header bg-lightblue">
                  <button type="button" id="btnCrearGrupo" class="btn btn-outline-light">Crear grupo</button>
                  <div class="search mt-3">
                      <input type="text" placeholder="Buscar..." class="form-control">
                  </div>
                </div>
                <div class="card-body direct-chat-messages">
                  <ul class="contacts-list mt-2">
                    <li class="bg-light">
                      <a href="#">
                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Said Ricardes
                            <small class="contacts-list-date float-right">04/08/2023</small>
                          </span>
                          <span class="contacts-list-msg">Cerramos el departamento a las 5pm.</span>
                        </div>
                        <!-- /.contacts-list-info -->
                      </a>
                    </li>
                    <!-- End Contact Item -->
                  </ul>
                <!-- Contacts are loaded here -->
                  <!-- /.contatcts-list -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="card direct-chat direct-chat-primary">
            <div class="card-header bg-lightblue">
                <div>
                  <h5>Said Ricardes</h5>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Said Ricardes</span>
                      <span class="direct-chat-timestamp float-right">2:00 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="../dist/img/saidriw.jpg" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                    Buenas tardes! Tengo una consulta.
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right"><?php echo $_SESSION['Nombres'], " ", $_SESSION['ApellidoPaterno'];?></span>
                      <span class="direct-chat-timestamp float-left">2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="<?php echo $_SESSION['img']; ?>" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                     Buenas tardes ¿En qué le puedo ayudar?
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Said Ricardes</span>
                      <span class="direct-chat-timestamp float-right">2:07 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="../dist/img/saidriw.jpg" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      ¿Cómo puedo solicitar una constancia de estudio?
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right"><?php echo $_SESSION['Nombres'], " ", $_SESSION['ApellidoPaterno'];?></span>
                      <span class="direct-chat-timestamp float-left">2:09 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="<?php echo $_SESSION['img'];?>" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                    Tienes que entrar a el siguiente enlace certificadosUTCH.com y seguir 
                    los pasos, una vez concluido me mandas un mensaje para darle seguimiento.
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                  <!-- Message to the right -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Said Ricardes</span>
                      <span class="direct-chat-timestamp float-right">2:10 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="../dist/img/saidriw.jpg" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      ¡Perfecto muchas gracias! ¿Hasta que hora lo encuentro por aqui?
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right"><?php echo $_SESSION['Nombres'], " ", $_SESSION['ApellidoPaterno'];?></span>
                      <span class="direct-chat-timestamp float-left">2:09 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="<?php echo $_SESSION['img'];?>" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      Cerramos el departamento a las 5pm.
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                  <!-- /.direct-chat-msg -->
                </div>
                <!--/.direct-chat-messages-->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <form action="#" method="post">
                  <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                      <button type="submit" class="btn bg-navy">Send</button>
                    </span>
                  </div>
                </form>
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->
    <!-- CREAR GRUPO -->
    <div class="modal fade" tabindex="-1" id="registrarGrupoChat" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
          <form id="frmNuevoGrupoChat">
              <div class="card-body">
                <div class="form-group">
                  <label for="txtNombre">Nombre</label>
                  <input type="text" class="form-control" id="txtNombre" name="txtNombre">
                </div>
                <div class="form-group">
                        <label for="selGrupo">Grupo</label>
                        <select class="form-control" id="selGrupo" name="selGrupo" required>
                        </select>
                </div>
              </div>
                <!-- /.card-body -->
          </form>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-center mb-4">
              <button type="button" class="btn btn-primary mr-2 w-25" id="btnGuardarGrupoChat">Crear </button>
              <button type="button" class="btn btn-outline-danger w-25" id="btnCancelarGrupoChat">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
		
    <!-- FIN MODAL CREAR GRUPO -->


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Funciones JS -->
<script src="../js/a1chat.js"></script>
<!-- Sweet Alert -->
<script src="../dist/js/sweetalert2.all.min.js"></script>
</body>
</html>
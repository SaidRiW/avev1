<?php

  include '../clases/cDashboard.php';
  
  $noti = new cDashboard();
  $notis1 = $noti->notificacionCitasE();
  $notis2 = $noti->notificacionPublicacionesE();
  $notis3 = $noti->notificacionCitasCancelE();

  $total = count($notis1) + count($notis2) + count($notis3);
?>

<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-navy navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php
            if(count($notis1) != '0'){
          ?>
          <span class="badge badge-warning navbar-badge"><?php echo $total ?></span>
          <?php
            }
          ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo $total ?> notificaciones</span>
          <div class="dropdown-divider"></div>
          <?php
          foreach ($notis1 as $row) {
            $ad = $noti->extraerAdmin($row["Usuario1"]);
            foreach($ad as $adr) {
          ?>
          <a href="ecalendario.php" class="dropdown-item notification-link" data-notification-id="<?php echo $row['IDNotificacion']; ?>">
            <i class="fas fa-calendar-plus mr-2" style="color:#6F42C1"></i><?php echo $adr["Nombres"], " ", $adr["ApellidoPaterno"], " ", $row["Tipo"]; ?>
            <span class="float-right text-muted text-sm"><?php echo $row["Fecha"] ?></span>
          </a>
          <?php
              }
            }
          ?>
          <?php
          foreach ($notis2 as $row) {
            $ad = $noti->extraerAdmin($row["Usuario1"]);
            foreach($ad as $adr) {
          ?>
          <a href="ecomunidad.php" class="dropdown-item notification-link" data-notification-id="<?php echo $row['IDNotificacion']; ?>">
            <i class="fab fa-slideshare mr-2" style="color:#28A745"></i><?php echo $adr["Nombres"], " ", $adr["ApellidoPaterno"], " ", $row["Tipo"]; ?>
            <span class="float-right text-muted text-sm"><?php echo $row["Fecha"] ?></span>
          </a>
          <?php
              }
            }
          ?>
          <?php
          foreach ($notis3 as $row) {
            $ad = $noti->extraerAdmin($row["Usuario1"]);
            foreach($ad as $adr) {
          ?>
          <a href="ecalendario.php" class="dropdown-item notification-link" data-notification-id="<?php echo $row['IDNotificacion']; ?>">
            <i class="fas fa-calendar-minus mr-2" style="color:#DB3545"></i><?php echo $adr["Nombres"], " ", $adr["ApellidoPaterno"], " ", $row["Tipo"]; ?>
            <span class="float-right text-muted text-sm"><?php echo $row["Fecha"] ?></span>
          </a>
          <?php
              }
            }
          ?>
        </div>
      </li>
      <!-- User dropdown menu -->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo $_SESSION['img'];?>" class="user-image img-circle elevation-2" alt="User Image">
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-dark">
            <img src="<?php echo $_SESSION['img'];?>" class="img-circle elevation-2" alt="User Image">

            <p>
              <?php echo $_SESSION['CorreoInstitucional'];?>
              <small><?php echo $_SESSION['rol'];?></small>
            </p>
          </li>
          <!-- Menu Body -->
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="perfil.php" class="btn btn-default btn-flat">Perfil</a>
            <a href="../controladores/cerrarSesion.php" class="btn btn-default btn-flat float-right">Cerrar sesión</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <script src="../plugins/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
        $('.notification-link').on('click', function(e) {
            e.preventDefault();
            var notificationId = $(this).data('notification-id');
            //alert('notificationId: ' + notificationId);
            $.ajax({
                url: '../controladores/ctrl_notificacion.php',
                method: 'POST',
                data: { notificationId: notificationId },
                success: function(response) {
                    // Notificación marcada como leída, redirige al usuario al destino original
                    window.location.href = $(e.target).attr('href');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Manejar errores si la solicitud falla
                }
            });
        });
    });
</script>
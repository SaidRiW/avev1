  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-dnavy elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../dist/img/logo.png" alt="AVE Logo" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Agenda Virtual Escolar</span>
    </a>
    <style>
      .sidebar-dark-dnavy{
        background-color: #000c2d;
      }
    </style>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <!-- Opcion Menu -->
            <?php  if($_SESSION['rol']=='Administrativo'){//Si no hay un usuario logueado, regresar al logueo**
            ?>
          <li class="nav-item">
            <a href="a2calendario.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Calendario
              </p>
            </a>
          </li>
          <?php
            }
          ?>
            <?php  if($_SESSION['rol']=='Administrativo'){//Si no hay un usuario logueado, regresar al logueo**
            ?>
          <li class="nav-item">
            <a href="a2citas.php" class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Citas
              </p>
            </a>
          </li>
          <?php
            }
          ?>
          <?php  if($_SESSION['rol']=='Estudiante'){//Si no hay un usuario logueado, regresar al logueo**
          ?>
          <li class="nav-item">
            <a href="ecalendario.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Calendario
              </p>
            </a>
          </li>
          <?php
            }
          ?>
          <?php  if($_SESSION['rol']=='Estudiante'){//Si no hay un usuario logueado, regresar al logueo**
          ?>
          <li class="nav-item">
            <a href="eeventos.php" class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Eventos
              </p>
            </a>
          </li>
          <?php
            }
          ?>
          <?php  if($_SESSION['rol']=='Estudiante'){//Si no hay un usuario logueado, regresar al logueo**
          ?>
          <li class="nav-item">
            <a href="eagendar.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-day"></i>
              <p>
                Agendar
              </p>
            </a>
          </li>
          <?php
            }
          ?>
          <?php  if($_SESSION['rol']=='Administrativo'||$_SESSION['rol']=='Docente'){//Si no hay un usuario logueado, regresar al logueo**
          ?>
          <li class="nav-item">
            <a href="a1comunidad.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Comunidad
              </p>
            </a>
          </li>
          <?php
            }
          ?> 
          <?php  if($_SESSION['rol']=='Estudiante'){//Si no hay un usuario logueado, regresar al logueo**
          ?>
          <li class="nav-item">
            <a href="ecomunidad.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Comunidad
              </p>
            </a>
          </li>
          <?php
            }
          ?> 
            <?php  if($_SESSION['rol']=='Docente'){//Si no hay un usuario logueado, regresar al logueo**
            ?>
          <li class="nav-item">
            <a href="a1chat.php" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Chat
              </p>
            </a>
          </li>
          <?php
            }
          ?> 
            <?php  if($_SESSION['rol']=='Administrativo'){//Si no hay un usuario logueado, regresar al logueo**
            ?>
          <li class="nav-item">
            <a href="a2chat.php" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Chat
              </p>
            </a>
          </li>
          <?php
            }
          ?> 
          <?php  if($_SESSION['rol']=='Estudiante'){//Si no hay un usuario logueado, regresar al logueo**
          ?>
          <li class="nav-item">
            <a href="echat.php" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Chat
              </p>
            </a>
          </li>
          <?php
            }
          ?> 
          <li class="nav-item">
            <a href="perfil.php" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Perfil
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
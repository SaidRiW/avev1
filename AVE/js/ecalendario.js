document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'es',
    themeSystem: "bootstrap",
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: '../controladores/ctrl_ecalendario.php',
    eventClick: function(info) {
      // Hacer una solicitud AJAX al controlador para obtener detalles del evento
      $.ajax({
        url: '../controladores/ctrl_ecalendario.php',
        type: 'GET',
        data: { idEvento: info.event.id },
        dataType: 'json',
        success: function(data) {
          var modalType = data.extendedProps.tipo; // Obtener el tipo de evento
      
          // Abre el modal correspondiente al tipo de evento
          switch (modalType) {
            case 'Personal':
              abrirModalPersonal(data);
              break;
            case 'Comunidad':
              abrirModalComunidad(data);
              break;
            case 'Cita':
              abrirModalCita(data);
              break;
            default:
              // Caso por defecto si no se reconoce el tipo
              console.error('Tipo de evento no reconocido:', modalType);
              break;
          }
        },
        error: function(error) {
          console.error('Error al obtener detalles del evento:', error);
        }
      });
    }

  });


  // Funciones para abrir los modales según el tipo de evento
  function abrirModalPersonal(data) {
    var modal = $('#modalPersonal');
    modal.find('.modal-title').text(data.titulo);
    modal.find('.modal-body').html(
    '<p><strong>Fecha inicio:</strong> ' + data.fecha_inicio + '</p>' +
    '<p><strong>Descripción:</strong> ' + data.descripcion + '</p>' +
    '<p><strong>Tipo de evento:</strong> ' + data.extendedProps.tipo + '</p>'
    );

    // Abre el modal
    modal.modal('show');
  }

  function abrirModalComunidad(data) {
    var modal = $('#modalComunidad');
    modal.find('.modal-title').text(data.titulo);
    modal.find('.modal-body').html(
    '<p><strong>Fecha inicio:</strong> ' + data.fecha_inicio + '</p>' +
    '<p><strong>Fecha final:</strong> ' + data.fecha_fin + '</p>' +
    '<p><strong>Descripción:</strong> ' + data.descripcion + '</p>' +
    '<p><strong>Tipo de evento:</strong> ' + data.extendedProps.tipo + '</p>'
    );

    // Abre el modal
    modal.modal('show');
  }

  function abrirModalCita(data) {
    var modal = $('#modalCita');
    modal.find('.modal-title').text(data.titulo);
    modal.find('.modal-body').html(
    '<p><strong>Fecha inicio:</strong> ' + data.fecha_inicio + '</p>' +
    '<p><strong>Nombre del administrativo:</strong> ' + data.nombre_admin + '</p>' +
    '<p><strong>Servicio:</strong> ' + data.servicio + '</p>' +
    '<p><strong>Tipo de evento:</strong> ' + data.extendedProps.tipo + '</p>'
    );

    // Abre el modal
    modal.modal('show');
  }


  calendar.render();

  });
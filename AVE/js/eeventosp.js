//Método que crea y configura un objeto DataTable para
//procesar datos en una base de datos.
function crearDataTableEP(nombreTabla) {
	tabla = $(nombreTabla).DataTable({
		"responsive": true, "lengthChange": false, "autoWidth": false,
        "columns":[
            {"data":"titulo"},
            {"data":"fecha_hora"},
            {"data":"descripcion"},
            {"data": "idevento",
             "render":function(data,type,row){
                 var idevento = data;										
                 return '<div class="btn-group">'+
                 '<button id="btnEditar" name="'+idevento+'" class="btn btn-sm btn-success ml-1" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editarEvn('+idevento+')"><i class="far fa-edit"></i></button>' +
                 '<button id="btnVisualizar" name="'+idevento+'" class="btn btn-sm bg-purple ml-1" data-toggle="tooltip" data-placement="top" title="Visualizar" onclick="verEvn('+idevento+')"> <i class="far fa-eye"></i></button>' +
                 '<button id="btnEliminar" name="'+idevento+'" class="btn btn-sm btn-danger ml-1" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminarEvn('+idevento+')"> <i class="fas fa-times"></i></button>'
                 +'</div>';
             }
            }
        ],
        "language": {
            "decimal": "",
            "emptyTable": "No existe ningún registro en la tabla.",
            "info": "Registros del _START_ al _END_ (_TOTAL_ registros totales)",
            "infoEmpty": "Registros del 0 al 0 (0 registros totales)",
            "infoFiltered": "(Filtro de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "searchPlaceholder": "Capture el valor a buscar",
            "zeroRecords": "No se encontró ningún resultado.",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "lengthChange": true,					//Habilitar o deshabilitar la lista desplegable para seleccionar la cantidad de registros mostrador por página
        "lengthMenu": [5, 10, 15, 20, 25],	//Definir los valores que aparederán en la lista desplegable para seleccionar la cantidad de registros mostrador por página
        "searching": true,						//Habilitar o deshabilitar la búsqueda en la tabla
        "ordering": true,						//Habilitar o deshabilitar el ordenamiento de columnas en la tabla
        "order": [[ 1, 'asc' ]],				//Definir el tipo de ordenamiento por default en cada una de las columnas de la tabla
        "columnDefs": [{						//Habilitar o deshabilitar el ordenamiento y filtrado en columnas específicas de la tabla
	    	"targets": [3],					//Define la columna o columnas afectadas "NC", "[C1, C2, ..., CN"], "_all", ".nombre-clase"
	    	"searchable": false,					//Habilitar o deshabilitar la búsqueda en la columna o columnas
	    	"orderable": false					//Habilitar o deshabilitar el ordenamiento en la columna o columnas
	    }],
        "pageLength": 5,						//Definir el número que registros que mostrarán de manera inicial en cada página
        "info": true,							//Habilitar y deshabilitar del información referente al número de registros mostrador por página
        "pagingType": "simple_numbers"			//"numbers" "simple_numbers" "full_numbers" "first_last_numbers" 
		
	});
   
    return tabla;
}

//Método que obtiene los datos a través de AJAX para visualizarlos en la tabla
//Accede 
function mostrarTablaEvenPer(tablaEventosP) {
    tablaEventosP.ajax.url("../controladores/ctrl_eventosp.php?opcion=5");
    tablaEventosP.ajax.reload();
}

function limpiaCamposDatosRegistro(){
    $("#frmEditarEvento")[0].reset();

}

function validaCamposEditarEven(){
    
    let faltaCampo=0;
    let mensaje = "Todos los campos son obligatorios!"
    //Obtener los valores de los campos
    let txtTitulo = $("#txtTituloE").val();
    let fechaEvento = $("#dateFechaEvenE").val();
    let txtDescripcion = $("#txtDescripcionE").val();

    if(txtTitulo == ""){
        faltaCampo = 1;			
    }
    if(fechaEvento == ""){
        faltaCampo = 1;			
    }
    if(txtDescripcion == ""){
        faltaCampo = 1;			
    }
    if(faltaCampo==1){
        Swal.fire({
            title: "¡Faltan campos!",//Avisa duplicidad
            text: "Todos los campos deben estar llenos!",
            icon: "warning",
            dangerMode: true
        });
        return false;
    }else{
        return true;
    }    
}

function modificaEvento(idevento){
    //Obtener los datos del formulario
    let formData = new FormData(document.getElementById("frmEditarEvento"));
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controladores/ctrl_eventosp.php?opcion=3&idevento="+idevento,
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success:function(data){
            
            if(data['success']==1){
                Swal.fire({
                    title:'¡Modificación exitosa!',
                    text:data['message'],
                    icon:'success',
                    confirmButtonColor: '#0a2963',
                    confirmButtonText: 'CERRAR'
                });
                               
                //Cerrar la ventana modal
                $('#editarEvento').modal('toggle');
                
            }
            else{
                Swal.fire({
                    title: "Error!",
                    text: data['message'],
                    icon: "warning",
                    dangerMode: true
                });
            }
        
        }
    });
	
}

function editarEvn(idevento){
    //Traer datos del evento
    $.ajax({
        type: "POST",
        data: "idevento=" + idevento,
        url: "../controladores/ctrl_eventosp.php?opcion=4",
        success:function(respuesta){
            datos = JSON.parse(respuesta);
            //Mostrar datos en el formulario de edicion
            $('#txtIdEventoE').val(datos[0]['idevento']);
            $('#txtTituloE').val(datos[0]['titulo']);
            $('#dateFechaEvenE').val(datos[0]['fecha_hora']);
            $('#txtDescripcionE').val(datos[0]['descripcion']);
            $('#selPrioridadE').val(datos[0]['prioridad']);
        }
    });

    $('#editarEvento').modal({"backdrop"  : "static"});
}

function verEvn(idevento){
    //Traer datos del evento
    $.ajax({
        type: "POST",
        data: "idevento=" + idevento,
        url: "../controladores/ctrl_eventosp.php?opcion=4",
        success:function(respuesta){
            datos = JSON.parse(respuesta);
            //Mostrar datos en el formulario de edicion
            $('#txtIdEventoV').val(datos[0]['idevento']);
            $('#txtTituloV').val(datos[0]['titulo']);
            $('#dateFechaEvenV').val(datos[0]['fecha_hora']);
            $('#txtDescripcionV').val(datos[0]['descripcion']);
            $('#selPrioridadV').val(datos[0]['prioridad']);
        }
    });

    $('#verEvento').modal({"backdrop"  : "static"});
}

//Función que elimina un evento personal en ls BD
function eliminarEvn(idevento){
    Swal.fire({
        title:'¿Estás seguro de eliminar el evento?',
        text:'¡Esta acción no se puede revertir!',
        icon:'question',
        showCancelButton: true,
        confirmButtonColor: '#0a2963',
        cancelButtonColor: '#c21919',
        confirmButtonText: '¡Si, eliminar!',
        cancelButtonText: 'No, cancelar'
    }).then((result) => {
        if (result.isConfirmed){
            $.ajax({
                type: "POST",
                dataType: "json",
                url:"../controladores/ctrl_eventosp.php?opcion=2&idevento="+idevento,
                async: false,
                cache: false,
                success: function(data){
                    if(data['success']==1){
                        Swal.fire({
                            title:'¡Eliminación exitosa!',
                            text:data['message'],
                            icon:'success',
                            confirmButtonColor: '#0a2963',
                            confirmButtonText: 'CERRAR'
                        });
                        //Recargar la tabla de publicaciones
                        tablaEventosPAlias.ajax.reload();
                    }else{
                        Swal.fire({
                            title:'¡Error!',
                            text: data['message'],
                            icon:'warning',
                            dangerMode:true
                        });
                    }
                }
            });
        }
    });  
}

//Alias para la dataTables tablaEventosP, como variable global
let tablaEventosPAlias;

//Método ready() representa el avento load del documento
//Ejecuta el código dentro de él cuando se carga completamente el documento

$(document).ready(function() {

    //Crear un objeto datatables, a través de un método llamado crearDataTable y le envía el ID de la tabla HTML 
    //creada en el documento de la vista eventosp.php.
    let tablaEventosP = crearDataTableEP("#tablaEvnP");

    tablaEventosPAlias = tablaEventosP;

    mostrarTablaEvenPer(tablaEventosP);

    //Evento click del btnCancelarPublicacionE del formulario frmEditarEvento
	$('#btnCancelarEventoE').click(function(){
		limpiaCamposDatosRegistro();
        $('#editarEvento').modal('toggle');
	});

    //Evento click del btnGuardarEventoE del formulario frmEditarEvento
    $('#btnGuardarEventoE').click(function(){
        if(!validaCamposEditarEven())
            return;
        
        modificaEvento($("#txtIdEventoE").val());
        mostrarTablaEvenPer(tablaEventosP);
             
    });

    //Evento click del btnCerrarEventoV del formulario frmVerEvento
	$('#btnCerrarEventoV').click(function(){
		limpiaCamposDatosRegistro();
        $('#verEvento').modal('toggle');
	});


});
//Método que crea y configura un objeto DataTable para
//procesar datos en una base de datos.
function crearDataTableC(nombreTabla) {
	tabla = $(nombreTabla).DataTable({
		"responsive": true, "lengthChange": false, "autoWidth": false,
        "columns":[
            {"data":"titulo"},
            {"data":"fechainicio"},
            {"data":"fechafin"},
            {"data":"descripcion"},
            {"data": "idpublicacion",
             "render":function(data,type,row){
                 var idpublicacion = data;										
                 return '<div class="btn-group">'+
                 '<a id="btnVisualizar" name="'+idpublicacion+'" class="btn btn-sm bg-purple ml-1" data-toggle="tooltip" data-placement="top" title="Visualizar" href="ecalendario.php"> <i class="far fa-eye"></i></a>' +
                 '<button id="btnEliminar" name="'+idpublicacion+'" class="btn btn-sm btn-danger ml-1" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminarEventoC('+idpublicacion+')"> <i class="fas fa-times"></i></button>'
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
	    	"targets": [4],					//Define la columna o columnas afectadas "NC", "[C1, C2, ..., CN"], "_all", ".nombre-clase"
	    	"searchable": false,					//Habilitar o deshabilitar la búsqueda en la columna o columnas
	    	"orderable": false					//Habilitar o deshabilitar el ordenamiento en la columna o columnas
	    }],
        "pageLength": 5,						//Definir el número que registros que mostrarán de manera inicial en cada página
        "info": true,							//Habilitar y deshabilitar del información referente al número de registros mostrador por página
        "pagingType": "simple_numbers"			//"numbers" "simple_numbers" "full_numbers" "first_last_numbers" 
		
	});
   
    return tabla;
}

function mostrarTablaEventosC(tablaEventosC) {
    tablaEventosC.ajax.url("../controladores/ctrl_publicacion.php?opcion=6");
    tablaEventosC.ajax.reload();
}

//Método que carga los grupos de la BD a un select
function cargaGruposVer(){
    //Uso de Ajax para traer los datos de los grupos
	$.ajax({ 
        type: "GET",
        dataType: 'json',	       
        cache: false, 
        url: "../controladores/ctrl_grupos.php?opcion=5", 
        success: function(data){ 
                    //Limpiar el select llamado selGrupo
                    $("#selGrupoV").empty();
                    //Agregar uno por uno las grupos obtenidos de la BD
                    $(data).each(function(indice,registro){                   
                       $("#selGrupoV").append("<option value=" + registro.IDGrupo + ">" + registro.Nombre + "</option>"); 
                    });
        }
    });   
}

function limpiaCamposDatosRegistro(){
    $("#frmNuevaPublicacion")[0].reset();

} 

function visualizarPublicacion(idpublicacion){
    cargaGruposVer();	
    //Traer datos de la publicacion
    $.ajax({
        type: "POST",
        data: "idpublicacion=" + idpublicacion,
        url: "../controladores/ctrl_publicacion.php?opcion=4",
        success:function(respuesta){
            datos = JSON.parse(respuesta);
            //Mostrar datos en el formulario de edicion
            $('#txtTituloCV').val(datos[0]['titulo']);
            $('#dateFechaInicioEvenV').val(datos[0]['fechainicio']);
            $('#dateFechaFinEvenV').val(datos[0]['fechafin']);
            $('#txtDescripcionCV').val(datos[0]['descripcion']);
            $('#selPrioridadV').val(datos[0]['prioridad']);
        }
    });

    $('#verPc').modal({"backdrop"  : "static"});
}


//Función que elimina un evento de comunidad para un solo estudiante en la BD
function eliminarEventoC(idpublicacion){
    Swal.fire({
        title:'¿Estás seguro de desechar este evento?',
        text:'¡Esta acción no se puede revertir!',
        icon:'question',
        showCancelButton: true,
        confirmButtonColor: '#0a2963',
        cancelButtonColor: '#c21919',
        confirmButtonText: '¡Si, desechar!',
        cancelButtonText: 'No, cancelar'
    }).then((result) => {
        if (result.isConfirmed){
            $.ajax({
                type: "POST",
                dataType: "json",
                url:"../controladores/ctrl_publicacion.php?opcion=7&idpublicacion="+idpublicacion,
                async: false,
                cache: false,
                success: function(data){
                    if(data['success']==1){
                        Swal.fire({
                            title:'Desecho exitoso!',
                            text:data['message'],
                            icon:'success',
                            confirmButtonColor: '#0a2963',
                            confirmButtonText: 'CERRAR'
                        });
                        //Recargar la tabla de publicaciones
                        tablaEventosCAlias.ajax.reload();
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

//Alias para la dataTables tablaEventosC, como variable global
let tablaEventosCAlias;


//Método ready() representa el avento load del documento
//Ejecuta el código dentro de él cuando se carga completamente el documento

$(document).ready(function() {

    //Crear un objeto datatables, a través de un método llamado crearDataTable y le envía el ID de la tabla HTML 
    //creada en el documento de la vista a1comunidad.php.
    let tablaEventosC = crearDataTableC("#tablaEventosC");

    tablaEventosCAlias = tablaEventosC;

    mostrarTablaEventosC(tablaEventosC);

    //Evento click del btnCerrarPublicacionV del formulario frmVerPC
	$('#btnCerrarPublicacionV').click(function(){
		limpiaCamposDatosRegistro();
        $('#verPc').modal('toggle');
	});
 
});
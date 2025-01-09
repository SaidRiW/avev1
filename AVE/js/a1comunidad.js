//Método que crea y configura un objeto DataTable para
//procesar datos en una base de datos.
function crearDataTableP(nombreTabla) {
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
                 '<button id="btnEditar" name="'+idpublicacion+'" class="btn btn-sm btn-success ml-1" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editarPublicacion('+idpublicacion+')"><i class="far fa-edit"></i></button>' +
                 '<button id="btnVisualizar" name="'+idpublicacion+'" class="btn btn-sm bg-purple ml-1" data-toggle="tooltip" data-placement="top" title="Visualizar" onclick="visualizarPublicacion('+idpublicacion+')"> <i class="far fa-eye"></i></button>' +
                 '<button id="btnEliminar" name="'+idpublicacion+'" class="btn btn-sm btn-danger ml-1" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminarPublicacion('+idpublicacion+')"> <i class="fas fa-times"></i></button>'
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

//Método que obtiene los datos a través de AJAX para visualizarlos en la tabla
//Accede 
function mostrarTablaPublicaciones(tablaPublicaciones) {
    tablaPublicaciones.ajax.url("../controladores/ctrl_publicacion.php?opcion=5");
    tablaPublicaciones.ajax.reload();
}

//Método que carga los grupos de la BD a un select
function cargaGrupos(){
    //Uso de Ajax para traer los datos de los grupos
	$.ajax({ 
        type: "GET",
        dataType: 'json',	       
        cache: false, 
        url: "../controladores/ctrl_grupos.php?opcion=5", 
        success: function(data){ 
                    //Limpiar el select llamado selGrupo
                    $("#selGrupo").empty();
                    //Agregar uno por uno las grupos obtenidos de la BD
                    $(data).each(function(indice,registro){                   
                       $("#selGrupo").append("<option value=" + registro.IDGrupo + ">" + registro.Nombre + "</option>"); 
                    });
        }
    });   
}

//Método que carga los grupos de la BD a un select
function cargaGruposEditar(){
    //Uso de Ajax para traer los datos de losgrupos
	$.ajax({ 
        type: "GET",
        dataType: 'json',	       
        cache: false, 
        url: "../controladores/ctrl_grupos.php?opcion=5", 
        success: function(data){ 
                    //Limpiar el select llamado selGrupo
                    $("#selGrupoE").empty();
                    //Agregar uno por uno las grupos obtenidos de la BD
                    $(data).each(function(indice,registro){                   
                       $("#selGrupoE").append("<option value=" + registro.IDGrupo + ">" + registro.Nombre + "</option>"); 
                    });
        }
    });   
}

//Método que carga los grupos de la BD a un select
function cargaGruposVer(){
    //Uso de Ajax para traer los datos de losgrupos
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

function validaCamposPublicacion(){
    
    let faltaCampo=0;
    let mensaje = "Todos los campos son obligatorios!"
    //Obtener los valores de los campos
    let txtTitulo = $("#txtTitulo").val();

    if(txtTitulo == ""){
        faltaCampo = 1;			
    }

    if(faltaCampo==1){
        Swal.fire({
            title: "Faltan campos!",//Avisa duplicidad
            text: "Todos los campos deben estar llenos!",
            icon: "warning",
            dangerMode: true
        });
        return false;
    }else{
        return true;
    }    
}

function validaCamposEditarPcn(){
    
    let faltaCampo=0;
    let mensaje = "Todos los campos son obligatorios!"
    //Obtener los valores de los campos
    let txtTitulo = $("#txtTituloE").val();

    if(txtTitulo == ""){
        faltaCampo = 1;			
    }

    if(faltaCampo==1){
        Swal.fire({
            title: "Faltan campos!",//Avisa duplicidad
            text: "Todos los campos deben estar llenos!",
            icon: "warning",
            dangerMode: true
        });
        return false;
    }else{
        return true;
    }    
}

function guardaPublicacion(){
    //Obtener los datos del formulario
    let formData = new FormData(document.getElementById("frmNuevaPublicacion"));
    
    //Uso de ajax para enviar el formulario y procesar los datos
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controladores/ctrl_publicacion.php?opcion=1",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
           
            if(data['success']==1){
                Swal.fire({
                    title:'¡Creación exitosa!',
                    text:data['message'],
                    icon:'success',
                    confirmButtonColor: '#0a2963',
                    confirmButtonText: 'CERRAR'
                });
               //Limpiar los campos de la ventana modal
                limpiaCamposDatosRegistro();

            }//Fin if data success
            else{
                Swal.fire({
                    title: "Error!",//Avisa duplicidad
                    text: data['message'],
                    icon: "warning",
                    dangerMode: true
                });
            }
        } //Fin success						
    }); //Fin ajax		
}



function modificaPublicacion(idpublicacion){
    //Obtener los datos del formulario
    let formData = new FormData(document.getElementById("frmEditarPc"));
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controladores/ctrl_publicacion.php?opcion=3&idpublicacion="+idpublicacion,
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
                $('#editarPc').modal('toggle');
                
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

function editarPublicacion(idpublicacion){
    cargaGruposEditar();	
    //Traer datos de la publicacion
    $.ajax({
        type: "POST",
        data: "idpublicacion=" + idpublicacion,
        url: "../controladores/ctrl_publicacion.php?opcion=4",
        success:function(respuesta){
            datos = JSON.parse(respuesta);
            //Mostrar datos en el formulario de edicion
            $('#txtIdPublicacionE').val(datos[0]['idpublicacion']);
            $('#txtTituloE').val(datos[0]['titulo']);
            $('#dateFechaInicioEvenE').val(datos[0]['fechainicio']);
            $('#dateFechaFinEvenE').val(datos[0]['fechafin']);
            $('#txtDescripcionE').val(datos[0]['descripcion']);
            $('#selPrioridadE').val(datos[0]['prioridad']);
            $('#selGrupoE').val(datos[0]['idgrupo']);
            $('#fImgE').val(datos[0]['imagen']);
        }
    });

    $('#editarPc').modal({"backdrop"  : "static"});
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
            $('#txtIdPublicacionV').val(datos[0]['idpublicacion']);
            $('#txtTituloV').val(datos[0]['titulo']);
            $('#dateFechaInicioEvenV').val(datos[0]['fechainicio']);
            $('#dateFechaFinEvenV').val(datos[0]['fechafin']);
            $('#txtDescripcionV').val(datos[0]['descripcion']);
            $('#selPrioridadV').val(datos[0]['prioridad']);
            $('#selGrupoV').val(datos[0]['idgrupo']);
            $('#fImgV').val(datos[0]['imagen']);
        }
    });

    $('#verPc').modal({"backdrop"  : "static"});
}

//Función que elimina una publicación en ls BD
function eliminarPublicacion(idpublicacion){
    Swal.fire({
        title:'¿Estás seguro de eliminar la publicación?',
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
                url:"../controladores/ctrl_publicacion.php?opcion=2&idpublicacion="+idpublicacion,
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
                        tablaPublicacionesAlias.ajax.reload();
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

//Alias para la dataTables tablaPublicaciones, como variable global
let tablaPublicacionesAlias;

//Método ready() representa el avento load del documento
//Ejecuta el código dentro de él cuando se carga completamente el documento

$(document).ready(function() {

    //Crear un objeto datatables, a través de un método llamado crearDataTable y le envía el ID de la tabla HTML 
    //creada en el documento de la vista a1comunidad.php.
    let tablaPublicaciones = crearDataTableP("#tablaPublicaciones");

    tablaPublicacionesAlias = tablaPublicaciones;

    mostrarTablaPublicaciones(tablaPublicaciones);

    //Asociar el evento onclick del elemento btnCrearPublicacion con la apertura
    //del formulario modal
    $('#btnNuevaPublicacion').click(function(){
    //LLamado al método que carga el catálogo de grupos de la BD al elemento select que se llama selGrupo
    cargaGrupos();
    $("#txtTitulo").focus();	
    //Mostrar cuadro de diálogo del formulario
    $('#registrarPublicacion').modal({"backdrop"  : "static"});		
    }); //Fin evento click

    //Evento click del btnCancelarPublicacion del formulario frmNuevaPublicacion
	$('#btnCancelarPublicacion').click(function(){
		limpiaCamposDatosRegistro();
        $('#registrarPublicacion').modal('toggle');
	});

    //Evento click del btnGuardarPublicación del formulario frmNuevaPublicacion
    $('#btnGuardarPublicacion').click(function(){
        if(!validaCamposPublicacion())
            return;

        guardaPublicacion();
        mostrarTablaPublicaciones(tablaPublicaciones);     
    });

        //Evento click del btnCancelarPublicacionE del formulario frmEditarPc
	$('#btnCancelarPublicacionE').click(function(){
		limpiaCamposDatosRegistro();
        $('#editarPc').modal('toggle');
	});

    //Evento click del btnGuardarPublicacionE del formulario frmEditarPc
    $('#btnGuardarPublicacionE').click(function(){
        if(!validaCamposEditarPcn())
            return;
        
        modificaPublicacion($("#txtIdPublicacionE").val());
        mostrarTablaPublicaciones(tablaPublicaciones);
             
    });

    //Evento click del btnCerrarPublicacionV del formulario frmVerPc
	$('#btnCerrarPublicacionV').click(function(){
		limpiaCamposDatosRegistro();
        $('#verPc').modal('toggle');
	});
   
    //Crear un objeto datatables, a través de un método llamado crearDataTable y le envía el ID de la tabla HTML 
    //creada en el documento de la vista a1comunidad.php.
    let tablaEventosC = crearDataTableC("#tablaEventosC");
    mostrarTablaEventosC(tablaEventosC);
 
});
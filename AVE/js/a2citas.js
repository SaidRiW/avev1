//Método que crea y configura un objeto DataTable para
//procesar datos en una base de datos.
function crearDataTable(nombreTabla) {
	tabla = $(nombreTabla).DataTable({
		"responsive": true, "lengthChange": false, "autoWidth": false,
        "columns":[
            {"data":"fecha_hora"},
            {"data":"nombre_estudiante"},
            {"data":"nombre"},
            {"data": "idcita",
             "render":function(data,type,row){
                 var idcita = data;										
                 return '<div class="btn-group">'+
                 '<button id="btnEditar" name="'+idcita+'" class="btn btn-sm btn-success ml-1" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editarCita('+idcita+')"><i class="far fa-edit"></i></button>' +
                 '<button id="btnVisualizar" name="'+idcita+'" class="btn btn-sm bg-purple ml-1" data-toggle="tooltip" data-placement="top" title="Visualizar" onclick="verCita('+idcita+')"> <i class="far fa-eye"></i></button>' +
                 '<button id="btnEliminar" name="'+idcita+'" class="btn btn-sm btn-danger ml-1" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminarCita('+idcita+')"> <i class="fas fa-times"></i></button>'
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
function mostrarTablaCitas(tablaCitas) {
    tablaCitas.ajax.url("../controladores/ctrl_citas.php?opcion=5");
    tablaCitas.ajax.reload();
}

function limpiaCamposDatosRegistro(){
    $("#frmNuevaCita")[0].reset();

}

function validaCamposCita(){
    
    let faltaCampo=0;
    let mensaje = "Todos los campos son obligatorios!"
    //Obtener los valores de los campos
    let txtMatricula = $("#txtMatricula").val();
    let dateFechaCita = $("#dateFechaCita").val();

    if(txtMatricula == ""){
        faltaCampo = 1;			
    }

    if(dateFechaCita == ""){
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

function validaCamposEditarCta(){
    
    let faltaCampo=0;
    let mensaje = "Todos los campos son obligatorios!"
    //Obtener los valores de los campos
    let txtMatricula = $("#txtMatriculaE").val();
    let dateFechaCita = $("#dateFechaCitaE").val();

    if(txtMatricula == ""){
        faltaCampo = 1;			
    }

    if(dateFechaCita == ""){
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

function guardaCita(){
    //Obtener los datos del formulario
    let formData = new FormData(document.getElementById("frmNuevaCita"));
    
    //Uso de ajax para enviar el formulario y procesar los datos
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controladores/ctrl_citas.php?opcion=1",
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
                    icon: "error",
                    dangerMode: true
                });
            }
        } //Fin success						
    }); //Fin ajax		
}

function editarCita(idcita){	
    //Traer datos de la publicacion
    $.ajax({
        type: "POST",
        data: "idcita=" + idcita,
        url: "../controladores/ctrl_citas.php?opcion=4",
        success:function(respuesta){
            datos = JSON.parse(respuesta);
            //Mostrar datos en el formulario de edicion
            $('#txtIdCitaE').val(datos[0]['idcita']);
            $('#txtMatriculaE').val(datos[0]['matricula']);
            $('#dateFechaCitaE').val(datos[0]['fecha_hora']);
        }
    });

    $('#editarCt').modal({"backdrop"  : "static"});
}

function verCita(idcita){	
    //Traer datos de la publicacion
    $.ajax({
        type: "POST",
        data: "idcita=" + idcita,
        url: "../controladores/ctrl_citas.php?opcion=4",
        success:function(respuesta){
            datos = JSON.parse(respuesta);
            //Mostrar datos en el formulario de edicion
            $('#txtIdCitaV').val(datos[0]['idcita']);
            $('#txtMatriculaV').val(datos[0]['matricula']);
            $('#dateFechaCitaV').val(datos[0]['fecha_hora']);
        }
    });

    $('#verCt').modal({"backdrop"  : "static"});
}

function modificaCita(idcita){
    //Obtener los datos del formulario
    let formData = new FormData(document.getElementById("frmEditarCt"));
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controladores/ctrl_citas.php?opcion=3&idcita="+idcita,
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
                $('#editarCt').modal('toggle');
                
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

//Función que elimina una cita en ls BD
function eliminarCita(idcita){
    Swal.fire({
        title:'¿Estás seguro de cancelar la cita?',
        text:'¡Esta acción no se puede revertir!',
        icon:'question',
        showCancelButton: true,
        confirmButtonColor: '#0a2963',
        cancelButtonColor: '#c21919',
        confirmButtonText: '¡Si, cancelar!',
        cancelButtonText: 'No, cerrar'
    }).then((result) => {
        if (result.isConfirmed){
            $.ajax({
                type: "POST",
                dataType: "json",
                url:"../controladores/ctrl_citas.php?opcion=2&idcita="+idcita,
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
                        tablaCitasAlias.ajax.reload();
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

//Alias para la dataTables tablaCitas, como variable global
let tablaCitasAlias;


//Método ready() representa el avento load del documento
//Ejecuta el código dentro de él cuando se carga completamente el documento

$(document).ready(function() {

    //Crear un objeto datatables, a través de un método llamado crearDataTable y le envía el ID de la tabla HTML 
    //creada en el documento de la vista a2citas.php.
    let tablaCitas = crearDataTable("#tablaCitas");

    tablaCitasAlias = tablaCitas;

    mostrarTablaCitas(tablaCitas);

    //Asociar el evento onclick del elemento btnAgendarCita con la apertura
    //del formulario modal
    $('#btnAgendarCita').click(function(){		
        $('#registrarCita').modal({"backdrop"  : "static"});		
    }); //Fin evento click

    //Evento click del btnCancelarPublicacion del formulario frmNuevaCita
	$('#btnCancelarCita').click(function(){
		limpiaCamposDatosRegistro();
        $('#registrarCita').modal('toggle');
	});

    //Evento click del btnGuardarCita del formulario frmNuevaCita
    $('#btnGuardarCita').click(function(){
        if(!validaCamposCita())
            return;
        guardaCita();
        mostrarTablaCitas(tablaCitas);     
    });

        //Evento click del btnCancelarPublicacionE del formulario frmEditarCt
        $('#btnCancelarCitaE').click(function(){
            limpiaCamposDatosRegistro();
            $('#editarCt').modal('toggle');
        });
    
        //Evento click del btnGuardarPublicacionE del formulario frmEditarCt
        $('#btnGuardarCitaE').click(function(){
            if(!validaCamposEditarCta())
                return;
            
            modificaCita($("#txtIdCitaE").val());
            mostrarTablaCitas(tablaCitas);
                 
        });
        //Evento click del btnCerrarCitaV del formulario frmVerCt
        $('#btnCerrarCitaV').click(function(){
            limpiaCamposDatosRegistro();
            $('#verCt').modal('toggle');
        });
});
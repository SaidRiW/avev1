//Método que carga los grupos de la BD a un select
function cargaServicios(){
    //Uso de Ajax para traer los datos de los servicios
	$.ajax({ 
        type: "GET",
        dataType: 'json',	       
        cache: false, 
        url: "../controladores/ctrl_servicios.php?opcion=5", 
        success: function(data){ 
                    //Limpiar el select llamado selServicio
                    $("#selServicio").empty();
                    //Agregar uno por uno las servicios obtenidos de la BD
                    $(data).each(function(indice,registro){                   
                       $("#selServicio").append("<option value=" + registro.IDServicio + ">" + registro.Nombre + "</option>"); 
                    });
        }
    });   
}

function limpiaCamposDatosRegistroC(){
    $("#frmNuevaCita")[0].reset();

}

function limpiaCamposDatosRegistroE(){
    $("#frmNuevoEvento")[0].reset();

}

function validaCamposCita(){
    
    let faltaCampo=0;
    let mensaje = "Todos los campos son obligatorios!"
    //Obtener los valores de los campos
    let selServicio = $("#selServicio").val();
    let dateFechaCita = $("#dateFechaCita").val();

    if(selServicio == ""){
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

function validaCamposEvento(){
    
    let faltaCampo=0;
    let mensaje = "Todos los campos son obligatorios!"
    //Obtener los valores de los campos
    let txtTitulo = $("#txtTitulo").val();
    let fechaEvento = $("#dateFechaEven").val();
    let txtDescripcion = $("#txtDescripcion").val();

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

function guardaEvento(){
    //Obtener los datos del formulario
    let formData = new FormData(document.getElementById("frmNuevoEvento"));
    
    //Uso de ajax para enviar el formulario y procesar los datos
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controladores/ctrl_eventosp.php?opcion=1",
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
                limpiaCamposDatosRegistroE();

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

function guardaCita(){
    //Obtener los datos del formulario
    let formData = new FormData(document.getElementById("frmNuevaCita"));
    
    //Uso de ajax para enviar el formulario y procesar los datos
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controladores/ctrl_ecitas.php?opcion=1",
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


//Método ready() representa el avento load del documento
//Ejecuta el código dentro de él cuando se carga completamente el documento

$(document).ready(function() {

    //Asociar el evento onclick del elemento btnAgendarcita con la apertura
    //del formulario modal
    $('#btnAgendarCita').click(function(){		
        $('#registrarCita').modal({"backdrop"  : "static"});		
    }); //Fin evento click
     
    //LLamado al método que carga el catálogo de grupos de la BD al elemento select que se llama selServicio
    cargaServicios();
    $("#selServicio").focus();	
    //Mostrar cuadro de diálogo del formulario
    
    //Evento click del btnCancelarPublicacion del formulario frmNuevaCita
	$('#btnCancelarCita').click(function(){
		limpiaCamposDatosRegistroC();
        $('#registrarCita').modal('toggle');
        window.location.href = window.location.href;
	});

    //Evento click del btnGuardarCita del formulario frmNuevaCita
    $('#btnGuardarCita').click(function(){
        if(!validaCamposCita())
            return;
        guardaCita();    
    });



    //Asociar el evento onclick del elemento btnAgendarEvento con la apertura
    //del formulario modal
    $('#btnAgendarEvento').click(function(){		
        $('#registrarEvento').modal({"backdrop"  : "static"});		
    }); //Fin evento click

    //Si se cancela el nuevo evento 
	$('#btnCancelarEvento').click(function(){
		limpiaCamposDatosRegistroE();
		$('#registrarEvento').modal('toggle');
        window.location.href = window.location.href;
	});

    //Evento click del btnGuardarEvento del formulario frmNuevaEvento
    $('#btnGuardarEvento').click(function(){
        if(!validaCamposEvento())
            return;
        
        guardaEvento();
    });
 
});
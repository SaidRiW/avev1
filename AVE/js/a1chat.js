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


function limpiaCamposDatosRegistro(){
    $("#frmNuevoGrupoChat")[0].reset();

}


function validaCamposGrupo(){
    
    let faltaCampo=0;
    let mensaje = "Todos los campos son obligatorios!"
    //Obtener los valores de los campos
    let txtNombre = $("#txtNombre").val();

    if(txtNombre == ""){
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

//Método ready() representa el avento load del documento
//Ejecuta el código dentro de él cuando se carga completamente el documento

$(document).ready(function() {

    //Asociar el evento onclick del elemento btnCrearGrupo con la apertura
    //del formulario modal
    $('#btnCrearGrupo').click(function(){	
    //LLamado al método que carga el catálogo de grupos de la BD al elemento select que se llama selGrupo
    cargaGrupos();
    $("#txtNombre").focus();	
    //Mostrar cuadro de diálogo del formulario	
        $('#registrarGrupoChat').modal({"backdrop"  : "static"});		
    }); //Fin evento click

    //Evento click del btnCancelarGrupoChatS del formulario frmNuevoGrupo
	$('#btnCancelarGrupoChat').click(function(){
		limpiaCamposDatosRegistro();
        $('#registrarGrupoChat').modal('toggle');
	});

    //Evento click del btnGuardarGrupoChat del formulario frmNuevoGrupo
    $('#btnGuardarGrupoChat').click(function(){
        if(!validaCamposGrupo())
            return; 
    });
});
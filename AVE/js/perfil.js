function modificaFotoPerfil(id_usuario){
    //Obtener los datos del formulario
    let formData = new FormData(document.getElementById("frmCambiaFotoPerfil"));
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controladores/ctrl_perfil.php?opcion=1&id_usuario="+id_usuario,
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success:function(data){
            
            if(data['success']==1){
                Swal.fire({
                    title:'Éxito!',
                    text:data['message'],
                    icon:'success'
                });
                               
                //Cerrar la ventana modal
                $('#cambiarFotoPerfil').modal('toggle');
                
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

$(document).ready(function() {

    //Asociar el evento onclick del elemento btnCambiaFotoPerfil con la apertura
    //del formulario modal
    $('#btnCambiarFotoPerfil').click(function(){	
    //Mostrar cuadro de diálogo del formulario	
        $('#cambiarFotoPerfil').modal({"backdrop"  : "static"});		
    }); //Fin evento click

    //Evento click del btnCancelarFotoPerfil del formulario frmCambiaFotoPerfil
	$('#btnCancelarFotoPerfil').click(function(){
		$("#frmCambiaFotoPerfil")[0].reset();
        $('#cambiarFotoPerfil').modal('toggle');
	});

    //Evento click del btnGuardarFotoPerfil del formulario frmCambiaFotoPerfil
    $('#btnGuardarFotoPerfil').click(function(){
        modificaFotoPerfil(idUsuario);
    });
});
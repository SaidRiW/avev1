/*
Método $(document).ready() de la librería jquery, se ejecuta cuando se carga completamente el documeto HTML.

Para esta página, se realizan dos tareas principales: 
-Validar el formulario
-Enviar el formulario para su procesamiento

Ambas tareas al hacer clic el botón enviar del formulario.

*/
$(document).ready(function(){
    //Evento clic del button con id "entrarSistema"
    //Al hacer clic en el botón se ejecuta la siguiente función anónima 
    $('#entrarSistema').click(function(){
       
        //****** Valida los campos que no esten vacios *****

        let campoVacio  = false;

        if($('#correo').val()==""){
            campoVacio = true;
        }

        if($('#contrasena').val()==""){
            campoVacio = true;
        }

        //Si hubo algún campo vacío?
        if(campoVacio){
            Swal.fire({
                title: "Faltan campos!",
                text: "Rellena todos los campos!",
                icon: "warning"
            });
            //Salir de la función en el evento clic del button
            return false;
        }
        //*** Fin validar campos del formulario

        //****Si los campos no estan vacios, manda los datos a un URL para procesarlo
        //Obtiene los datos del formulario
        let datos=$('#frmLogin').serialize();
        //Ejecuta Ajax, usando la librería jquery
        $.ajax({
            //Tipo de envío del formulario
            type:"POST",
            //Datos del formulario
            data:datos,
            //URL donde se envía el formulario
            url:"controladores/ctrl_sesion.php?inicia_sesion=1",
            //Si la respuesta del URL fue exitosa, se recibe la respuesta en "r"
            success:function(respuesta){
                if(respuesta==1){
                    //Si los datos son correctos, se direcciona a la pagina principal de la pagina
                    window.location="controladores/redirect.php";
                }else{
                    //De lo contrario, aparece la siguiente alerta
                    Swal.fire({
                        title: "Error!",
                        text: "Correo o contraseña incorrectos!",
                        icon: "warning",
                        dangerMode: true
                    });
                }
            }
        }); //Termina código ajax
    }); //Termina código evento clic
}); //Termina método .ready()


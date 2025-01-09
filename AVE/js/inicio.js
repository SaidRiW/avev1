/*
Método $(document).ready() de la librería jquery, se ejecuta cuando se carga completamente el documeto HTML.
*/
$(document).ready(function(){
      
        //Estadística eventosp
        $.ajax({            
            //Tipo de envío del formulario
            type:"GET",
            dataType: "json",
            //URL de acceso
            url:"../controladores/ctrl_dashboard.php?opcion=1",
            success:function(respuesta){                
                $("#noEventosP").text(respuesta["count"]);
            }
        }); //Termina código ajax

        //Estadística eventosc
        $.ajax({            
            //Tipo de envío del formulario
            type:"GET",
            dataType: "json",
            //URL de acceso
            url:"../controladores/ctrl_dashboard.php?opcion=2",
            success:function(respuesta){                
                $("#noEventosC").text(respuesta["count"]);
            }
        }); //Termina código ajax

        //Estadística citas
        $.ajax({            
            //Tipo de envío del formulario
            type:"GET",
            dataType: "json",
            //URL de acceso
            url:"../controladores/ctrl_dashboard.php?opcion=3",
            success:function(respuesta){                
                $("#noCitas").text(respuesta["count"]);
            }
        }); //Termina código ajax

}); //Termina método .ready()


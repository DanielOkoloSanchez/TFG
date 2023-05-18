     $(document).ready(function(){
        $.ajax({
            url: "obtenerEjercicios.php",
            dataType: "json",
            success: function(data) {
               
                console.log(data);  
        
               
                $.each(data, function(index, entrenamiento) {
                    $("#ejerUno").append("<option value='" + entrenamiento.id + "'>" + entrenamiento.nombre + "</option>");
                    $("#ejerDos").append("<option value='" + entrenamiento.id + "'>" + entrenamiento.nombre + "</option>");
                    $("#ejerTres").append("<option value='" + entrenamiento.id + "'>" + entrenamiento.nombre + "</option>");
                    $("#ejerCuatro").append("<option value='" + entrenamiento.id + "'>" + entrenamiento.nombre + "</option>");
                    $("#ejerCinco").append("<option value='" + entrenamiento.id + "'>" + entrenamiento.nombre + "</option>");
                });
            },
            error: function(xhr, status, error) {
                console.log("Error en la petición AJAX: " + error);
            }
        });

        $("#parte-cuerpo").on("change", function() {
            var valorSeleccionado = $(this).val();
            
        });

        $("#ejerUno").on("change", function() {
            var valorSeleccionado = $(this).val();
            console.log(valorSeleccionado)
        });

        $("#ejerDos").on("change", function() {
            var valorSeleccionado = $(this).val();
            console.log(valorSeleccionado)
        });

       
    });

    
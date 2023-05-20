     class GestionDatos {
         constructor() {

         }



         obtenerValoresSelect() {
             $.ajax({
                 url: 'obtenerEjercicios.php',
                 type: 'POST',
                 data: {
                     action: 'obtenerValoresSelect'
                 },
                 dataType: 'json',
                 success: function (data) {
                     if (data && data.length > 0) { 
                         console.log(data);
                         $.each(data, function (index, entrenamiento) {
                             $(".ejer").append("<option value='" + entrenamiento.id + "'>" + entrenamiento.nombre + "</option>");
                         });
                     } else {
                         console.log("La respuesta del servidor no contiene datos JSON válidos.");
                     }
                 },
                 error: function (xhr, status, error) {
                     console.log("Error en la petición AJAX: " + error);
                 }
             });
         }


         mandarFiltroCuerpo() {
            $("#parte-cuerpo").on("change", function () {
              var parteCuerpo = $(this).val();
              console.log(parteCuerpo);
          
              $.ajax({
                url: 'obtenerEjercicios.php',
                type: 'POST',
                data: {
                  action: 'obtenerValoresSelectFiltrado',
                  parteCuerpo: parteCuerpo
                },
                dataType: 'json',
                success: function (data) {
                  if (data && data.length > 0) {
                    console.log(data);
                    var selectEjercicios = $(".ejer"); 
                    var valorSeleccionado = selectEjercicios.val();
          
                    
                    selectEjercicios.find("option:not(:selected)").remove();
          
                    $.each(data, function (index, entrenamiento) {
                      if (entrenamiento.id !== valorSeleccionado) {
                        selectEjercicios.append("<option value='" + entrenamiento.id + "'>" + entrenamiento.nombre + "</option>");
                      }
                    });
                  } else {
                    console.log("La respuesta del servidor no contiene datos JSON válidos.");
                  }
                },
                error: function (xhr, status, error) {
                  console.log("Error en la petición AJAX: " + error);
                }
              });
            });
          }

     }





     $(document).ready(function () {

         let datos = new GestionDatos();
         datos.obtenerValoresSelect();
         datos.mandarFiltroCuerpo();


         $(".ejer").on("change", function () {
             var valorSeleccionado = $(this).val();
             console.log(valorSeleccionado)
         });

         $("#ejerDos").on("change", function () {
             var valorSeleccionado = $(this).val();
             console.log(valorSeleccionado)
         });


     });
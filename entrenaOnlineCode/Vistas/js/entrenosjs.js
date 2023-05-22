     class GestionDatos {
       constructor() {

       }



       obtenerValoresSelect() {
         $.ajax({
           url: 'enlaceDatosEntreno.php',
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

       reiniciarFiltro() {
         $(".reset-button").on("click", () => {
          $('#parte-cuerpo')[0].selectedIndex = 0;
          $(".reset-button").prop('disabled', true);
           var selectEjercicios = $(".ejer");
           var valorSeleccionado = selectEjercicios.val();
           selectEjercicios.find("option:not(:selected)").remove();
           $.ajax({
             url: 'enlaceDatosEntreno.php',
             type: 'POST',
             data: {
               action: 'obtenerValoresSelect'
             },
             dataType: 'json',
             success: function (data) {
               if (data && data.length > 0) {
                 console.log(data);
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


       recibirFiltroCuerpo() {
         $("#parte-cuerpo").on("change", function () {
           var parteCuerpo = $(this).val();
           $.ajax({
             url: 'enlaceDatosEntreno.php',
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


       checkFiltroValor() {
         $('#parte-cuerpo').on('input', function () {
           console.log()
          if ($(this).val() !== "def") {
             $(".reset-button").prop('disabled', false);
           } else {
             $(".reset-button").prop('disabled', true);
           }
           var nuevoValor = $(this).val();
         });
       }

       
      }

      
     $(document).ready(function () {
       let datos = new GestionDatos();
       datos.checkFiltroValor();
       datos.reiniciarFiltro();
       datos.obtenerValoresSelect();
       datos.recibirFiltroCuerpo();
      
      

       $(".ejer").on("change", function () {
         var valorSeleccionado = $(this).val();
         console.log(valorSeleccionado)
       });

       $("#ejerDos").on("change", function () {
         var valorSeleccionado = $(this).val();
         console.log(valorSeleccionado)
       });


     });
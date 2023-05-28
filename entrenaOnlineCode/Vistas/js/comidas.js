     class GestionDatosComidas   {
       constructor() {
     
        this.caloriasConsumidasTotal = 0;
        
      
       }

       


       obtenerValoresReceta() {
        
        $.ajax({
           url: 'enlaceDatos.php',
           type: 'POST',
           data: {
             action: 'obtenerValoresRecetas'
           },
           dataType: 'json',
           success: function (data) {
             if (data && data.length > 0) {
               console.log(data);
               $.each(data, function (index, receta) {

                
                
                if (receta.momentoComida === "cena" || receta.momentoComida === "comida" ) {
                  $("#recetaComida").append("<option value='" + receta.id + "'>" + receta.nombre + "</option>");
                  $("#recetaCena").append("<option value='" + receta.id + "'>" + receta.nombre + "</option>");
                }else if (receta.momentoComida == "desayuno"){
                  $("#recetaDesayuno").append("<option value='" + receta.id + "'>" + receta.nombre + "</option>");
                }else{
                  $("#recetaMerienda").append("<option value='" + receta.id + "'>" + receta.nombre + "</option>");
                  $("#recetaMeriendaDos").append("<option value='" + receta.id + "'>" + receta.nombre + "</option>");
                }

                
               });
             } else {
              $('#myToast5').toast('show');
             }
           },
           error: function (xhr, status, error) {
            $('#myToast4').toast('show');
           }
         });
       }

     

      

      

       obtenerValoresFormulario() {
         var valores = [];
         var formulario = $('#formulario')[0];
         var recetas = $('.receta');

        //  valores.push($('#nombre').val());
        //  valores.push($('#dias-semana').val());

         recetas.each(function () {
           var valor = $(this).val();
          
             valores.push(valor);
           
         });

         return valores;
       }

    



      comprobarValoresNulos(valores) {
        var valoresNulos = false;
      
        for (var i = 0; i < valores.length; i++) {
          if (valores[i] === null || valores[i] === '' || valores[i] === 0 ) {
            valoresNulos = true;
            break;
          }
        }
      
        return valoresNulos;
      }

      checkValores() {
       
        var self = this;
        $('#formulario').on('submit', function (event) {
          event.preventDefault();
          var nombre = $('#nombre').val();
          var regex = /^[a-zA-Z0-9]+$/;
          var formulario = $('#formulario')[0];
          var valoresFormulario = self.obtenerValoresFormulario();
          
          console.log( valoresFormulario)
          // if (nombre.length > 15 || nombre.length < 3) {
          //   $('#myToast1').toast('show');
          //   formulario.reset();
          //   return;
          // } else if (!regex.test(nombre)) {
          //   $('#myToast2').toast('show');
          //   formulario.reset();
          //   return;
        
          // }

          if (self.comprobarValoresNulos(valoresFormulario)) {
            $('#myToast6').toast('show');
            formulario.reset();
            return;
          }
      
          if ($('#recetaComida').val() == $('#recetaCena').val() || $('#recetaMerienda').val() == $('#recetaMeriendaDos').val()  ) {
            $('#myToast7').toast('show');
            formulario.reset();
            return;
          }
          
          this.submit();
         
        });
      }

      obtenerCaloriasComida(comidaSeleccionada) {
        return new Promise(function(resolve, reject) {
          $.ajax({
            url: 'enlaceDatos.php',
            type: 'POST',
            data: {
              action: 'obtenerCaloriasComida',
              comidaSeleccionada: comidaSeleccionada
            },
            dataType: 'json',
            success: function(data) {
              if (data && data.calorias) {
                resolve(data.calorias);
              } else {
                reject("Error: No se encontraron calorías para la comida seleccionada.");
              }
            },
            error: function(xhr, status, error) {
              reject("Error en la petición AJAX: " + error);
            }
          });
        });
      }
    
      obtenerCaloriasConsumidas() {
        var self = this;
        var recetasSeleccionadas = [];
      
        $(".receta").on("change", function() {
          var comidaSeleccionada = $(this).val();
          
          // Verificar si la comida ya ha sido seleccionada anteriormente
          var index = recetasSeleccionadas.indexOf(comidaSeleccionada);
          if (index > -1) {
            // Restar las calorías de la comida anteriormente seleccionada
            var comidaAnterior = recetasSeleccionadas[index];
            self.obtenerCaloriasComida(comidaAnterior)
              .then(function(calorias) {
                self.caloriasConsumidasTotal -= parseInt(calorias);
                console.log(self.caloriasConsumidasTotal);
              })
              .catch(function(error) {
                console.error(error);
              });
            
            // Eliminar la comida anterior de la lista de seleccionadas
            recetasSeleccionadas.splice(index, 1);
          }
      
          // Añadir la nueva comida a la lista de seleccionadas
          recetasSeleccionadas.push(comidaSeleccionada);
      
          // Obtener las calorías de la nueva comida seleccionada
          self.obtenerCaloriasComida(comidaSeleccionada)
            .then(function(calorias) {
              self.caloriasConsumidasTotal += parseInt(calorias); // Sumar las calorías consumidas
              console.log(self.caloriasConsumidasTotal);
            })
            .catch(function(error) {
              console.error(error);
            });
        });
      }

      
  

    
    }
  
  

     $(document).ready(function () {
       let datos = new GestionDatosComidas();
       datos.obtenerCaloriasConsumidas()
       datos.checkValores();
       datos.obtenerValoresReceta();
   
      
       
       



       $(".ejer").on("change", function () {
         var valorSeleccionado = $(this).val();
         console.log(valorSeleccionado)
       });

       $("#ejerDos").on("change", function () {
         var valorSeleccionado = $(this).val();
         console.log(valorSeleccionado)
       });


     });
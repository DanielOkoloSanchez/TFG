     class GestionDatosComidas   {
       constructor() {
     
        this.caloriasConsumidasTotal = 0;
        this.caloriasAConsumir = 0;
        this.objetivo = "nada";
      
       }


       checkCalorias() {
        $('#formulario').on('submit', (event) => {
          const caloriasConsumidasTotal = parseFloat(this.caloriasConsumidasTotal);
          const caloriasAConsumir = parseFloat(this.caloriasAConsumir);
      
          if (isNaN(caloriasConsumidasTotal) || isNaN(caloriasAConsumir)) {
            // Manejar el caso en el que los valores no sean numéricos
            return;
          }
      
          if (caloriasConsumidasTotal < caloriasAConsumir && this.objetivo === "volumen") {
            $('#myToast8').toast('show');
          } else if (caloriasConsumidasTotal > caloriasAConsumir && (this.objetivo === "mantenimiento" || this.objetivo === "definicion")) {
            $('#myToast9').toast('show');
          } else {
            event.target.submit();
          }
        });
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
          if (nombre.length > 15 || nombre.length < 3) {
            $('#myToast1').toast('show');
            formulario.reset();
            return;
          } else if (!regex.test(nombre)) {
            $('#myToast2').toast('show');
            formulario.reset();
            return;
        
          }

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
        var recetasSeleccionadas = {};
      
        $(".receta").on("change", function() {
          var selectId = $(this).attr("id");
          var comidaSeleccionada = $(this).val();
      
          // Verificar si la comida seleccionada ha cambiado en el mismo select
          if (recetasSeleccionadas.hasOwnProperty(selectId)) {
            var comidaAnterior = recetasSeleccionadas[selectId];
      
            // Verificar si el valor de la comida seleccionada ha cambiado
            if (comidaSeleccionada !== comidaAnterior) {
              // Restar las calorías de la comida anterior
              self.obtenerCaloriasComida(comidaAnterior)
                .then(function(calorias) {
                  self.caloriasConsumidasTotal -= parseInt(calorias);
                  console.log(self.caloriasConsumidasTotal);
                })
                .catch(function(error) {
                  console.error(error);
                });
            }
          }
      
          // Guardar la nueva comida seleccionada en el mismo select
          recetasSeleccionadas[selectId] = comidaSeleccionada;
      
          // Sumar las calorías de la comida seleccionada
          self.obtenerCaloriasComida(comidaSeleccionada)
            .then(function(calorias) {
              self.caloriasConsumidasTotal += parseInt(calorias);
              $(".caloriasConsumidas").empty().append(self.caloriasConsumidasTotal);
            })
            .catch(function(error) {
              console.error(error);
            });
        });
      }
      


      calcularCalorias(peso, altura, edad, genero, objetivo , complexion) {
        let calorias = 0;
    
        
        if (genero === 'Hombre') {
          calorias = 88.362 + (13.397 * peso) + (4.799 * altura) - (5.677 * edad);
        } else if (genero === 'Mujer') {
          calorias = 447.593 + (9.247 * peso) + (3.098 * altura) - (4.330 * edad);
        }
        
        switch (complexion) {
          case 'Hectomorfo':
            calorias *= 0.9;
            break;
          case 'Endomorfo':
            calorias *= 1;
            break;
          case 'Mesoformo':
            calorias *= 1.1;
            break;
          default:
            break;
        }
       
        switch (objetivo) {
          case 'mantener':
            calorias *= 1;
            break;
          case 'volumen':
            calorias *= 1.2;
            break;
          case 'definir':
            calorias *= 0.8;
            break;
          default:
            break;
        }
  
        return Math.round(calorias);
  
      }

      calcularEdad(fechaNacimiento) {
        const fechaActual = new Date();
        const fechaNac = new Date(fechaNacimiento);
        
        let edad = fechaActual.getFullYear() - fechaNac.getFullYear();
        const mesActual = fechaActual.getMonth();
        const diaActual = fechaActual.getDate();
        const mesNac = fechaNac.getMonth();
        const diaNac = fechaNac.getDate();
        
        
        if (mesActual < mesNac || (mesActual === mesNac && diaActual < diaNac)) {
          edad--;
        }
        
        return edad;
      }
  
  
      obtenerCaloriasAConsumir() {
        const self = this;
          $.ajax({
            url: 'enlaceDatos.php',
            type: 'POST',
            data: {
              action: 'obtenerValoresUsuario'
            },
            dataType: 'json',
            success: function (data) {
              if (data) {
                self.objetivo = data.objetivo;
                
                self.caloriasAConsumir = self.calcularCalorias(data.peso, data.altura, self.calcularEdad(data.fechaNacimiento)  , data.sexo, data.objetivo , data.complexion)
                console.log(self.caloriasAConsumir);
              } else {
                  console.log(data);
                console.log("La respuesta del servidor no contiene datos JSON válidos.");
              }
            },
            error: function (xhr, status, error) {
              console.log("Error en la petición AJAX: " + error);
            }
          });
        }
  
    
       

    }
  
  

     $(document).ready(function () {
       let datos = new GestionDatosComidas();
       datos.checkCalorias();
       datos.obtenerValoresReceta();
       datos.obtenerCaloriasConsumidas()
       datos.checkValores();
       
       
       console.log(datos.obtenerCaloriasAConsumir());
      
      
       
       



       $(".ejer").on("change", function () {
         var valorSeleccionado = $(this).val();
         console.log(valorSeleccionado)
       });

       $("#ejerDos").on("change", function () {
         var valorSeleccionado = $(this).val();
         console.log(valorSeleccionado)
       });


     });
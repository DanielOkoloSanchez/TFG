     class GestionDatosComidas {
       constructor() {

         this.caloriasConsumidasTotal = 0;
         this.caloriasAConsumir = 0;
         this.objetivo = "nada";

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

                console.log(data);

                 if (receta.momentoComida === "cena" || receta.momentoComida === "comida") {
                   $("#recetaComida").append("<option value='" + receta.id + "'>" + receta.nombre + "</option>");
                   $("#recetaCena").append("<option value='" + receta.id + "'>" + receta.nombre + "</option>");
                 } else if (receta.momentoComida == "desayuno") {
                   $("#recetaDesayuno").append("<option value='" + receta.id + "'>" + receta.nombre + "</option>");
                 } else {
                   $("#recetaMerienda").append("<option value='" + receta.id + "'>" + receta.nombre + "</option>");
                   $("#recetaMeriendaDos").append("<option value='" + receta.id + "'>" + receta.nombre + "</option>");
                 }


               });
             } else {}
           },
           error: function (xhr, status, error) {
             $('#myToast4').toast('show');
           }
         });
       }



  checkCalorias() {
        
           const caloriasConsumidasTotal = parseFloat(this.caloriasConsumidasTotal);
           const caloriasAConsumir = parseFloat(this.caloriasAConsumir);

           if (isNaN(caloriasConsumidasTotal) || isNaN(caloriasAConsumir)) {
             $('#myToast4').toast('show');
             return;
           }

           if (caloriasConsumidasTotal < caloriasAConsumir && this.objetivo === "volumen") {
             $('#myToast8').toast('show');
             return
           } else if (caloriasConsumidasTotal > caloriasAConsumir && (this.objetivo === "mantenimiento" || this.objetivo === "definicion")) {
             $('#myToast9').toast('show');
             return
           } else {
            
           }
         
       }


       checkValores() {
        var self = this; 
        $('#formulario').submit(function(event) {
          event.preventDefault(); 
      
    
          var nombreDieta = $('#nombre').val();
          var recetaDesayuno = $('#recetaDesayuno').val();
          var recetaMerienda = $('#recetaMerienda').val();
          var recetaComida = $('#recetaComida').val();
          var recetaMeriendaDos = $('#recetaMeriendaDos').val();
          var recetaCena = $('#recetaCena').val();
      
          self.checkCalorias();

       
          if ($.trim(nombreDieta) === '') {
            $('#myToast6').toast('show'); 
            return;
          }
         
      
    
      
          if (/^\s/.test(nombreDieta) || /[^\w\s]/.test(nombreDieta)) {
            $('#myToast2').toast('show'); 
            return; 
          }
      
          if (nombreDieta.length < 3 || nombreDieta.length > 15) {
            $('#myToast1').toast('show'); 
            return; 
          }
      
          // Validación de las recetas
          if (recetaComida === recetaCena || recetaMerienda === recetaMeriendaDos) {
            $('#myToast7').toast('show'); 
            return; 
          }
      
          if (recetaDesayuno === '' || recetaMerienda === '' || recetaComida === '' || recetaMeriendaDos === '' || recetaCena === '') {
            $('#myToast6').toast('show'); 
            return; 
          }

          

          event.target.submit();
        });
      
      }
      

    

       obtenerCaloriasComida(comidaSeleccionada) {
         return new Promise(function (resolve, reject) {
           $.ajax({
             url: 'enlaceDatos.php',
             type: 'POST',
             data: {
               action: 'obtenerCaloriasComida',
               comidaSeleccionada: comidaSeleccionada
             },
             dataType: 'json',
             success: function (data) {
               if (data && data.calorias) {
                 resolve(data.calorias);
               } else {
                 reject("Error: No se encontraron calorías para la comida seleccionada.");
               }
             },
             error: function (xhr, status, error) {
               reject("Error en la petición AJAX: " + error);
             }
           });
         });
       }

       obtenerCaloriasConsumidas() {
         var self = this;
         var recetasSeleccionadas = {};

         $(".receta").on("change", function () {
           var selectId = $(this).attr("id");
           var comidaSeleccionada = $(this).val();

           
           if (recetasSeleccionadas.hasOwnProperty(selectId)) {
             var comidaAnterior = recetasSeleccionadas[selectId];

             if (comidaSeleccionada !== comidaAnterior) {
              
               self.obtenerCaloriasComida(comidaAnterior)
                 .then(function (calorias) {
                   self.caloriasConsumidasTotal -= parseInt(calorias);
                   console.log(self.caloriasConsumidasTotal);
                 })
                 .catch(function (error) {
                   console.error(error);
                 });
             }
           }

          
           recetasSeleccionadas[selectId] = comidaSeleccionada;

          
           self.obtenerCaloriasComida(comidaSeleccionada)
             .then(function (calorias) {
               self.caloriasConsumidasTotal += parseInt(calorias);
               $(".caloriasConsumidas").empty().append(self.caloriasConsumidasTotal);
             })
             .catch(function (error) {
               console.error(error);
             });
         });
       }



       calcularCalorias(peso, altura, edad, genero, objetivo, complexion) {
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

               self.caloriasAConsumir = self.calcularCalorias(data.peso, data.altura, self.calcularEdad(data.fechaNacimiento), data.sexo, data.objetivo, data.complexion)
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


       obtenerDietas() {

         $.ajax({
           url: 'enlaceDatos.php',
           type: 'POST',
           data: {
             action: 'obtenerDietasUsuario'
           },
           dataType: 'json',
           success: function (data) {
             if (data && data.length > 0) {
               console.log(data);
               $.each(data, function (index, dieta) {
                 $(".dieta").append("<option value='" + dieta.id + "'>" + dieta.nombre + "</option>");




               });
             } else {
               $('#myToast5').toast('show');
             }
           },
           error: function (xhr, status, error) {
             $('#myToast4').toast('show');
             console.log(error)
           }
         });
       }


       checkValoresHorario(){
        $('#formularioHorario').submit(function(event) {
          event.preventDefault();
      
          var nombreTabla = $('#nombre').val();
          var comidaLunes = $('#comidaLunes').val();
          var comidaMartes = $('#comidaMartes').val();
          var comidaMiercoles = $('#comidaMiercoles').val();
          var comidaJueves = $('#comidaJueves').val();
          var comidaViernes = $('#comidaViernes').val();
          var comidaSabado = $('#comidaSabado').val();
          var comidaDomingo = $('#comidaDomingo').val();
      
          
          var nombreValido = /^[a-zA-Z0-9\s]{3,15}$/.test(nombreTabla);
      
          if (nombreTabla === '' || !nombreValido || comidaLunes === '' || comidaMartes === '' ||
              comidaMiercoles === '' || comidaJueves === '' || comidaViernes === '' || comidaSabado === '' || comidaDomingo === '') {
                $('#myToast3').toast('show');
          } else {
            this.submit();
          }
        });
       }


       obtenerHorarios() {

         $.ajax({
           url: 'enlaceDatos.php',
           type: 'POST',
           data: {
             action: 'obtenerHorarios'
           },
           dataType: 'json',
           success: function (data) {
             if (data && data.length > 0) {
               console.log(data);
               $.each(data, function (index, horario) {

                 var row = '<tr>';
                 row += '<td>' + horario.nombreHorario + '</td>';
                 row += '<td><a href="alimentacionDiaVista.php?id=' + horario.HorarioLunesId + '&' + "horarioId="+horario.id + '">' + horario.HorarioLunes + '</a></td>';
                 row += '<td><a href="alimentacionDiaVista.php?id=' + horario.HorarioMartesId + '&' + "horarioId="+horario.id + '">' + horario.HorarioMartes + '</a></td>';
                 row += '<td><a href="alimentacionDiaVista.php?id=' + horario.HorarioMiercolesId + '&' + "horarioId="+horario.id + '">' + horario.HorarioMiercoles + '</a></td>';
                 row += '<td><a href="alimentacionDiaVista.php?id=' + horario.HorarioJuevesId + '&' + "horarioId="+horario.id + '">' + horario.HorarioJueves + '</a></td>';
                 row += '<td><a href="alimentacionDiaVista.php?id=' + horario.HorarioViernesId + '&' + "horarioId="+horario.id + '">' + horario.HorarioViernes + '</a></td>';
                 row += '<td><a href="alimentacionDiaVista.php?id=' + horario.HorarioSabadoId + '&' + "horarioId="+horario.id + '">' + horario.HorarioSabado + '</a></td>';
                 row += '<td><a href="alimentacionDiaVista.php?id=' + horario.HorarioDomingoId + '&' + "horarioId="+horario.id + '">' + horario.HorarioDomingo + '</a></td>';
                 row += '</tr>';
                 $(".horario tbody").append(row);



               });
             } else {
               $('#myToast5').toast('show');
              
             }
           },
           error: function (xhr, status, error) {
             $('#myToast4').toast('show');
             console.log(error)
           }
         });
       }


     }



     $(document).ready(function () {
       let datos = new GestionDatosComidas();
       datos.checkValores();
        datos.obtenerValoresReceta();
       datos.obtenerCaloriasConsumidas();
      datos.obtenerCaloriasAConsumir();







    

     });
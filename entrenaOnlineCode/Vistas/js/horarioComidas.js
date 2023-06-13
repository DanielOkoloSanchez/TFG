     class GestionHorariosComidas {
       constructor() {

         this.caloriasConsumidasTotal = 0;
         this.caloriasAConsumir = 0;
         this.objetivo = "nada";

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
       let datos = new GestionHorariosComidas(); 
       datos.checkValoresHorario();
       datos.obtenerDietas();
       datos.obtenerHorarios();
      






    

     });
class GestionDatosEntreno {
  constructor() {}

  obtenerValoresSelect() {
    $.ajax({
      url: 'enlaceDatos.php',
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
            $(".borrarEjer").append("<option value='" + entrenamiento.id + "'>" + entrenamiento.nombre + "</option>");
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

  obtenerValoresTabla() {
    $.ajax({
      url: 'enlaceDatos.php',
      type: 'POST',
      data: {
        action: 'obtenerValoresTabla'
      },
      dataType: 'json',
      success: function (data) {
        if (data && data.length > 0) {
          console.log(data);

          $.each(data, function (index, entrenamiento) {
            if (entrenamiento.diaSemana == "Lunes") {
              $(".lista-lunes").append("<a href= entrenoVista.php?EjerciciosId=" + entrenamiento.listaEntrenosid + "&Id=" + entrenamiento.id + ">" + "<li>" + entrenamiento.nombre + "</li>" + "</a>")
            } else if (entrenamiento.diaSemana == "Martes") {
              $(".lista-Martes").append("<a href= entrenoVista.php?EjerciciosId=" + entrenamiento.listaEntrenosid + "&Id=" + entrenamiento.id + ">" + "<li>" + entrenamiento.nombre + "</li>" + "</a>")
            } else if (entrenamiento.diaSemana == "Miercoles") {
              $(".lista-Miercoles").append("<a href= entrenoVista.php?EjerciciosId=" + entrenamiento.listaEntrenosid + "&Id=" + entrenamiento.id + ">" + "<li>" + entrenamiento.nombre + "</li>" + "</a>")
            } else if (entrenamiento.diaSemana == "Jueves") {
              $(".lista-Jueves").append("<a href= entrenoVista.php?EjerciciosId=" + entrenamiento.listaEntrenosid + "&Id=" + entrenamiento.id + ">" + "<li>" + entrenamiento.nombre + "</li>" + "</a>")
            } else {
              $(".lista-Viernes").append("<a href= entrenoVista.php?EjerciciosId=" + entrenamiento.listaEntrenosid + "&Id=" + entrenamiento.id + ">" + "<li>" + entrenamiento.nombre + "</li>" + "</a>")
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
  }

  rellenarSelectTablasEntrenaminto() {
    $.ajax({
      url: 'enlaceDatos.php',
      type: 'POST',
      data: {
        action: 'obtenerListaEntrenos'
      },
      dataType: 'json',
      success: function (data) {
        if (data && data.length > 0) {
          console.log(data);

          $.each(data, function (index, entrenamiento) {
            $("#listaEntrenoId").append("<option value='" + entrenamiento.id + "'>" + entrenamiento.nombre + "</option>");
            console.log(entrenamiento.id)
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
      this.obtenerValoresSelect();
    });
  }

   recibirFiltroCuerpo() {
    $("#parte-cuerpo").on("change", function() {
      var parteCuerpo = $("#parte-cuerpo").val();
      $.ajax({
        url: 'enlaceDatos.php',
        type: 'POST',
        data: {
          action: 'obtenerValoresSelectFiltrado',
          parteCuerpo: parteCuerpo
        },
        dataType: 'json',
        success: function(data) {
          if (data && data.length > 0) {
            console.log(data);
            var selectEjercicios = $(".ejer");
            var valorSeleccionado = selectEjercicios.val();
            selectEjercicios.find("option:not(:selected)").remove();
  
            $.each(data, function(index, entrenamiento) {
              if (entrenamiento.id !== valorSeleccionado) {
                selectEjercicios.append("<option value='" + entrenamiento.id + "'>" + entrenamiento.nombre + "</option>");
              }
            });
          } else {
            console.log("La respuesta del servidor no contiene datos JSON válidos.");
          }
        },
        error: function(xhr, status, error) {
          console.log("Error en la petición AJAX: " + error);
        }
      });
    });
  }
  

  checkFiltroValor() {
    $('#parte-cuerpo').on('input', function () {
      if ($(this).val() !== "def") {
        $(".reset-button").prop('disabled', false);
      } else {
        $(".reset-button").prop('disabled', true);
      }
    });
  }

  obtenerValoresFormulario() {
    var valores = [];
    var formulario = $('#formulario')[0];
    var ejercicios = $('.ejer');

    valores.push($('#nombre').val());

    ejercicios.each(function () {
      var valor = $(this).val();
      valores.push(valor);
    });

    return valores;
  }

  comprobarValoresRepetidos(valores) {
    var valoresRepetidos = false;

    for (var i = 0; i < valores.length; i++) {
      for (var j = i + 1; j < valores.length; j++) {
        if (valores[i] === valores[j]) {
          valoresRepetidos = true;
          break;
        }
      }
      if (valoresRepetidos) {
        break;
      }
    }

    return valoresRepetidos;
  }

  comprobarValoresNulos(valores) {
    var valoresNulos = false;

    for (var i = 0; i < valores.length; i++) {
      if (valores[i] === null || valores[i] === '') {
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

      console.log(valoresFormulario);
      if (nombre.length > 15 || nombre.length < 3) {
        $('#myToast1').toast('show');
        formulario.reset();
        return;
      } else if (!regex.test(nombre)) {
        $('#myToast2').toast('show');
        return;
      }

      if (self.comprobarValoresNulos(valoresFormulario)) {
        $('#myToast3').toast('show');
        return;
      }

      if (self.comprobarValoresRepetidos(valoresFormulario)) {
        $('#myToast4').toast('show');
        return;
      }

      this.submit();
      formulario.reset();
    });
  }

   validarFormularioCliente() {
    $('#formularioListaEntrenosDia').submit(function(e) {
      var diaSemana = $('#dias-semana').val();
      var listaEntrenoId = $('#listaEntrenoId').val();
  
      if (diaSemana === '' || listaEntrenoId === '') {
        $('#myToast3').toast('show');
        e.preventDefault(); // Evita que se envíe el formulario si hay campos vacíos
        return false;
      }
  
      this.submit();
      formulario.reset();
    });
  }

  validarCreadorEjer(){
    $('#formularioEjercicios').submit(function(event) {
      var nombreEjer = $('#nombreEjer').val();
      var descripcion = $('#descripcion').val();
      var regex = /^[a-zA-Z0-9\s\-\|.,?!]+$/; 
      var regexNombre = /^[a-zA-Z0-9\s]+$/; 
      
    

      if (nombreEjer.trim() === '' || descripcion.trim() === '') {
        $('#myToast6').toast('show');
        event.preventDefault();
      }
  
      if (!regexNombre.test(nombreEjer) || !regex.test(descripcion)) {
        $('#myToast6').toast('show');
        event.preventDefault(); 
      }
  
      if (nombreEjer.startsWith(' ') || descripcion.startsWith(' ')) {
        $('#myToast6').toast('show');
        event.preventDefault();
      }

      if (nombreEjer.length < 3 || nombreEjer.length > 15  || !/[a-zA-Z]{3,}/.test(nombreEjer)) {
        $('#myToast6').toast('show');
        event.preventDefault();
      }

      if (descripcion.length < 10 || descripcion.length > 255) {
        $('#myToast6').toast('show');
        event.preventDefault();
      }
      
    });
  
  }
   
}

$(document).ready(function () {
  
  let datos = new GestionDatosEntreno();
  datos.checkValores();
  datos.checkFiltroValor();
  datos.validarFormularioCliente();
  datos.validarCreadorEjer();
  datos.recibirFiltroCuerpo();
  datos.rellenarSelectTablasEntrenaminto();
  datos.obtenerValoresTabla();
  datos.reiniciarFiltro();
  datos.obtenerValoresSelect();
  
});

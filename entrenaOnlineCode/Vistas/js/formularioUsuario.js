class Formulario {
  constructor() {
    this.bindEvents();
  }

  bindEvents() {
    $('#crearUsuarios').submit(async (event) => {
      event.preventDefault();
      if (await this.validarFormulario()) {
        event.currentTarget.submit();
      }
    });
  }


  async validarFormulario() {
    var regex = /^[a-zA-Z]+$/;
    var regexNick = /^[a-zA-Z0-9]{1,15}$/;
    var decimalRegex = /^\d+(\.\d{1,2})?$/;  
    var nick = $('input[name="nick"]').val();
    var nombre = $('input[name="nombre"]').val();
    var primerApellido = $('input[name="primerApellido"]').val();
    var segundoApellido = $('input[name="segundoApellido"]').val();
    var altura = parseFloat($('input[name="altura"]').val());
    var peso = parseFloat($('input[name="peso"]').val());
    var fechaNacimiento = $('input[name="fechaNacimiento"]').val();
    var fechaActual = new Date();
    var fechaNac = new Date(fechaNacimiento);
    var edad = fechaActual.getFullYear() - fechaNac.getFullYear();

    if (await this.verificarNick(nick) === true) {
      this.mostrarToast("El NICK ya existe.");
      return false;
    }
  
    if (!regexNick.test(nick)) {
      this.mostrarToast("El campo Nick es inválido.");
      return false;
    }
  
    if (!regex.test(nombre) || nombre.length > 25) {
      this.mostrarToast("El campo Nombre es inválido o excede los 25 caracteres.");
      return false;
    }
  
    if (!regex.test(primerApellido) || primerApellido.length > 25) {
      this.mostrarToast("El campo Primer Apellido es inválido o excede los 25 caracteres.");
      return false;
    }
  
    if (!regex.test(segundoApellido) || segundoApellido.length > 25) {
      this.mostrarToast("El campo Segundo Apellido es inválido o excede los 25 caracteres.");
      return false;
    }
  
    if (isNaN(altura) || altura > 3 || altura <= 0 || !decimalRegex.test(altura.toFixed(2))) {
      this.mostrarToast("El campo Altura es inválido.");
      return false;
    }
  
    if (isNaN(peso) || peso < -999.9 || peso > 999.9 || peso.toFixed(1).split(".")[1].length > 1 || !decimalRegex.test(peso.toFixed(1))) {
      this.mostrarToast("El campo Peso es inválido o está fuera de rango.");
      return false;
    }
  
    if (fechaNac >= fechaActual ) {
      this.mostrarToast("La fecha de nacimiento no puede ser futura o actual.");
      return false;
    }

    if (edad < 11 || edad > 100) {
      this.mostrarToast("La edad debe estar entre 11 y 100 años.");
      return false;
    }
  
    return true;
  }

  
 
  
  

  mostrarToast(mensaje) {
    var toastContainer = $('#myToastContainer');

    toastContainer.empty();

    var toast = `
    <div class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true" style="opacity: 1; z-index: 9999; top: 80px; margin-top: 20px;">
    <div class="toast-body">${mensaje}</div>
  </div>
    `;

    $('#myToastContainer').append(toast);
    $('.toast').toast('show');
  }

  obtenerUsuarios() {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: 'enlaceDatos.php',
        type: 'POST',
        data: {
          action: 'obtenerUsuarios'
        },
        dataType: 'json',
        success: function (data) {
          if (data && data.length > 0) {
            console.log(data);
            var nicks = data.map(usuario => usuario.nombre);
            resolve(nicks);
          } else {
            console.log("La respuesta del servidor no contiene datos JSON válidos.");
            reject();
          }
        },
        error: function (xhr, status, error) {
          console.log("Error en la petición AJAX: " + error);
          reject();
        }
      });
    });
  }

  async verificarNick(nick) {
    try {
      const nicks = await this.obtenerUsuarios();
      if (nicks.includes(nick)) {
        return true;
      } else {
        return false;
      }
    } catch (error) {
      // Error al obtener los usuarios
      return false;
    }
  }
}

$(document).ready(function () {
  var formulario = new Formulario();
  
});

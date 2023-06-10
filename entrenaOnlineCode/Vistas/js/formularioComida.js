class FormularioComidaValidador {
  constructor() {
    this.bindEvents();
  }

  bindEvents() {
    $("#crearReceta").submit((event) => {
      event.preventDefault();
      if (this.validarFormulario()) {
        event.currentTarget.submit();
      }
    });
  }

  validarFormulario() {
    const nombre = $('input[name="nombre"]').val();
    const descripcion = $('textarea[name="descripcion"]').val();
    const calorias = parseInt($('input[name="calorias"]').val());

    if (!this.validarNombre(nombre)) {
      this.mostrarToast('El campo Nombre es inválido.');
      return false;
    }

    if (!this.validarDescripcion(descripcion)) {
      this.mostrarToast('El campo Descripción es inválido.');
      return false;
    }

    if (!this.validarCalorias(calorias)) {
      this.mostrarToast('El campo Calorías es inválido.');
      return false;
    }

    return true;
  }

  validarNombre(nombre) {
    if (nombre.trim() === '') {
      return false;
    }

    const regex = /^[a-zA-Z\s-]+$/;
    return regex.test(nombre);
  }

  validarDescripcion(descripcion) {
    if (descripcion.trim() === '') {
      return false;
    }

    const regex = /^[a-zA-Z0-9\s\-,.;:]+$/;
    return regex.test(descripcion);
  }

  validarCalorias(calorias) {
    return calorias <= 800;
  }

  mostrarToast(mensaje) {

    var toastContainer = $('#myToastContainer');

    toastContainer.empty();
    
    const toast = `
      <div class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">${mensaje}</div>
      </div>
    `;

    $('#myToastContainer').append(toast);
    $('.toast').toast('show');
  }




  obtenerAllReceta() {
        
    $.ajax({
      url: 'enlaceDatos.php',
      type: 'POST',
      data: {
        action: 'obtenerAllRecetas'
      },
      dataType: 'json',
      success: function (data) {
        if (data && data.length > 0) {
          console.log(data);
          $.each(data, function (index, receta) {

           console.log(data);

              $("#recetaBorrar").append("<option value='" + receta.id + "'>" + receta.nombre + "</option>");
            
          });
        } else {}
      },
      error: function (xhr, status, error) {
        $('#myToast4').toast('show');
      }
    });
  }


}

$(document).ready(function () {
  var formulario = new FormularioComidaValidador();
  formulario.obtenerAllReceta()
});

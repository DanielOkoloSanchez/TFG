class GestionDatosUsuario {
    constructor() {
      
      this.caloriasAConsumir = 0;

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

    calcularIMC(peso, altura ) {

        const alturaMetros = altura / 100; 
        const imc = peso / (alturaMetros * alturaMetros);
        return imc.toFixed(2); 
     
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

    obtenerValoresUsuario() {
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
              
              var card = $(".card"); 
              self.caloriasAConsumir = self.calcularCalorias(data.peso, data.altura, self.calcularEdad(data.fechaNacimiento)  , "Hombre", data.objetivo , data.complexion)

              card.find(".card-header").append("<h4>" + data.nombre +" " + data.primerApellido + "</h4>");
              
              card.find(".list-group").append("<li class='list-group-item'>Peso: " + data.peso + " kg</li>");
              card.find(".list-group").append("<li class='list-group-item'>Altura: " + data.altura + " cm</li>");
              card.find(".list-group").append("<li class='list-group-item'>Objetivo: " + data.objetivo + "</li>");
              card.find(".list-group").append("<li class='list-group-item'>Complexion: " + data.complexion + "</li>");
              card.find(".list-group").append("<li class='list-group-item'>Edad: " + self.calcularEdad(data.fechaNacimiento) + "</li>");
              card.find(".list-group").append("<li class='list-group-item'>IMC: " + self.calcularIMC(data.altura,data.peso) + "</li>");
              card.find(".list-group").append("<li class='list-group-item'>Calorias ha consumir: " + self.caloriasAConsumir + "Kcal" + "</li>");


              var nombre = $(".nombreCliente"); 
               var caloriasConsumir = $(".caloriasConsumir")
                console.log(self.cacatua);
                        nombre.append(data.nombre + " " + data.primerApellido);
                        caloriasConsumir.append(self.caloriasAConsumir + "Kcal");

                        
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
    let datos = new GestionDatosUsuario();
    
   
    datos.obtenerValoresUsuario();
   
   
});
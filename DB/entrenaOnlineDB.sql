drop database if exists entrenaOnlineDB ;
create database entrenaOnlineDB;
Use entrenaOnlineDB;

CREATE TABLE usuario (
  id INT PRIMARY KEY auto_increment,
  nombre VARCHAR(25) NOT NULL,
  clave VARCHAR(255) NOT NULL,
  rango ENUM('admin', 'client') NOT NULL
);

CREATE TABLE cliente (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(25) NOT NULL,
  primerApellido VARCHAR(25) NOT NULL,
  segundoApellido VARCHAR(25) NOT NULL,
  fechaNacimiento DATE NOT NULL,
  altura DECIMAL(3,2) NOT NULL,
  peso DECIMAL(4,1) NOT NULL,
  complexion ENUM('Hectomorfo', 'Mesoformo', 'Endomorfo') NOT NULL,
   objetivo ENUM('mantenimiento', 'volumen', 'definicion') NOT NULL,
  usuario_id INT NOT NULL UNIQUE,
  FOREIGN KEY (usuario_id) REFERENCES usuario(id)

);

CREATE TABLE entrenamientos (
  id INT PRIMARY KEY auto_increment,
  nombre VARCHAR(25) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  parteCuerpo ENUM ("pierna","brazo","pecho","espalda") NOT NULL
);



CREATE TABLE ListaEntrenoDia (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  entrenamiento1 INT NOT NULL,
  entrenamiento2 INT NOT NULL,
  entrenamiento3 INT NOT NULL,
  entrenamiento4 INT NOT NULL,
  entrenamiento5 INT NOT NULL,
  FOREIGN KEY (entrenamiento1) REFERENCES entrenamientos(id),
  FOREIGN KEY (entrenamiento2) REFERENCES entrenamientos(id),
  FOREIGN KEY (entrenamiento3) REFERENCES entrenamientos(id),
  FOREIGN KEY (entrenamiento4) REFERENCES entrenamientos(id),
  FOREIGN KEY (entrenamiento5) REFERENCES entrenamientos(id),
  clienteId INT NOT NULL,
  FOREIGN KEY (clienteId) REFERENCES cliente(id)
);











CREATE TABLE empleado (
  id INT PRIMARY KEY auto_increment,
  nombre VARCHAR(25) NOT NULL,
  primerApellido VARCHAR(25) NOT NULL,
  segundoApellido VARCHAR(25) NOT NULL,
  fechaNacimiento date NOT NULL,
  usuario_id INT NOT NULL UNIQUE,
  cargo ENUM('Entrenador', 'Mantenimiento', 'Recepcion') NOT NULL,
  FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

CREATE TABLE recetas (
  id INT PRIMARY KEY,
  nombre VARCHAR(25) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  elaboracion  VARCHAR(255) NOT NULL,
  calorias int NOT NULL,
  tipo ENUM('mantenimiento', 'volumen', 'definicion') NOT NULL
);



CREATE TABLE alimentacionDelDia (
  id INT PRIMARY KEY,
  desayuno VARCHAR(255) NOT NULL,
  meriendaMediaMañana VARCHAR(255) NOT NULL,
  comida VARCHAR(255) NOT NULL,
  meriendaTarde VARCHAR(255) NOT NULL,
  cena VARCHAR(255) NOT NULL
);


CREATE TABLE planesAlimentarios (
  id INT PRIMARY KEY,
  nombrePlan VARCHAR(30) NOT NULL,
  id_alimentacion INT not null,
  dia varchar(25) not null,
  FOREIGN KEY (id_alimentacion) REFERENCES alimentacionDelDia(id),
  cliente_id INT NOT NULL,
  FOREIGN KEY (cliente_id) REFERENCES cliente(id)
);






CREATE TABLE recetas_alimentacionDelDia (
  id_receta INT,
  id_alimentacion INT,
  FOREIGN KEY (id_receta) REFERENCES recetas(id),
  FOREIGN KEY (id_alimentacion) REFERENCES alimentacionDelDia(id),
  PRIMARY KEY (id_receta, id_alimentacion)
);

CREATE TABLE anuncios (
  id INT PRIMARY KEY auto_increment,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT NOT NULL,
  fecha DATE NOT NULL,
  empleado_id INT NOT NULL,
  FOREIGN KEY (empleado_id) REFERENCES empleado(id)
);
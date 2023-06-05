DROP DATABASE IF EXISTS entrenaOnlineDB;
CREATE DATABASE entrenaOnlineDB;
USE entrenaOnlineDB;

CREATE TABLE usuario (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(25) NOT NULL,
  clave VARCHAR(255) NOT NULL,
  rango ENUM('admin', 'client', 'superAdmin') NOT NULL
);

CREATE TABLE cliente (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(25) NOT NULL,
  primerApellido VARCHAR(25) NOT NULL,
  segundoApellido VARCHAR(25) NOT NULL,
  sexo ENUM('Hombre', 'Mujer') not null, 
  fechaNacimiento DATE NOT NULL,
  altura DECIMAL(3,2) NOT NULL,
  peso DECIMAL(4,1) NOT NULL,
  complexion ENUM('Hectomorfo', 'Mesoformo', 'Endomorfo') NOT NULL,
  objetivo ENUM('mantenimiento', 'volumen', 'definicion') NOT NULL,
  usuario_id INT NOT NULL UNIQUE,
  FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

CREATE TABLE entrenamientos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(25) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  parteCuerpo ENUM('pierna', 'brazo', 'pecho', 'espalda') NOT NULL
);


CREATE TABLE ListaEntrenos (
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
  FOREIGN KEY (entrenamiento5) REFERENCES entrenamientos(id)
);


CREATE TABLE ListaEntrenoDia (
  id INT PRIMARY KEY AUTO_INCREMENT,
  diaSemana ENUM('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes') NOT NULL,
  clienteId INT NOT NULL,
  listaEntrenosId int not null,
  FOREIGN KEY (listaEntrenosId) REFERENCES ListaEntrenos(id),
  FOREIGN KEY (clienteId) REFERENCES cliente(id)
);




CREATE TABLE empleado (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(25) NOT NULL,
  primerApellido VARCHAR(25) NOT NULL,
  segundoApellido VARCHAR(25) NOT NULL,
  fechaNacimiento DATE NOT NULL,
  usuario_id INT NOT NULL UNIQUE,
  cargo ENUM('Entrenador', 'Mantenimiento', 'Recepcion') NOT NULL,
  FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

CREATE TABLE recetas (
  id INT PRIMARY KEY,
  nombre VARCHAR(25) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  calorias INT NOT NULL,
  tipo ENUM('mantenimiento', 'volumen', 'definicion') NOT NULL,
  momentoComida enum ('desayuno','merienda','comida','cena') not null
);

CREATE TABLE alimentacionDelDia (
  id INT PRIMARY KEY auto_increment,
  nombre varchar(25) not null,
  desayuno INT NOT NULL,
  meriendaMedioDia INT NOT NULL,
  comida INT NOT NULL,
  meriendaTarde INT NOT NULL,
  cena INT NOT NULL,
  usuario_id int not null,
   FOREIGN KEY (usuario_id) REFERENCES usuario(id)
  
);



CREATE TABLE horarioAlimentos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombreHorario VARCHAR(30) NOT NULL,
  HorioComidaLunes INT NOT NULL,
  HorioComidaMartes INT NOT NULL,
  HorioComidaMiercoles INT NOT NULL,
  HorioComidaJueves INT NOT NULL,
  HorioComidaViernes INT NOT NULL,
  HorioComidaSabado INT NOT NULL,
  HorioComidaDomingo INT NOT NULL,
  clienteId int not null,
  FOREIGN KEY (HorioComidaLunes) REFERENCES alimentacionDelDia(id),
  FOREIGN KEY (HorioComidaMartes) REFERENCES alimentacionDelDia(id),
  FOREIGN KEY (HorioComidaMiercoles) REFERENCES alimentacionDelDia(id),
  FOREIGN KEY (HorioComidaJueves) REFERENCES alimentacionDelDia(id),
  FOREIGN KEY (HorioComidaViernes) REFERENCES alimentacionDelDia(id),
   FOREIGN KEY (HorioComidaSabado) REFERENCES alimentacionDelDia(id),
  FOREIGN KEY (HorioComidaDomingo) REFERENCES alimentacionDelDia(id),
  FOREIGN KEY (clienteId) REFERENCES cliente(id)
);



CREATE TABLE recetas_alimentacionDelDia (
  id_receta INT,
  id_alimentacion INT,
  FOREIGN KEY (id_receta) REFERENCES recetas(id),
  FOREIGN KEY (id_alimentacion) REFERENCES alimentacionDelDia(id),
  PRIMARY KEY (id_receta, id_alimentacion)
);

CREATE TABLE anuncios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT NOT NULL,
  fecha DATE NOT NULL,
  empleado_id INT NOT NULL,
  FOREIGN KEY (empleado_id) REFERENCES empleado(id)
);




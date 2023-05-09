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
  id INT PRIMARY KEY auto_increment,
  nombre VARCHAR(25) NOT NULL,
  primerApellido VARCHAR(25) NOT NULL,
  segundoApellido VARCHAR(25) NOT NULL,
  fechaNacimiento date NOT NULL,
  altura DECIMAL(3,2) NOT NULL,
  peso DECIMAL(4,1) NOT NULL,
  complexion ENUM('Hectomorfo', 'Mesoformo', 'Endomorfo') NOT NULL,
  objetivo ENUM('mantenimiento', 'volumen', 'definicion') NOT NULL,
  usuario_id INT NOT NULL UNIQUE,
  FOREIGN KEY (usuario_id) REFERENCES usuario(id)
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

CREATE TABLE comidas (
  id INT PRIMARY KEY,
  nombre VARCHAR(25) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  tipo ENUM('mantenimiento', 'volumen', 'definicion') NOT NULL
);

CREATE TABLE entrenamientos (
  id INT PRIMARY KEY,
  nombre VARCHAR(25) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  parteCuerpo ENUM ("pierna","brazo","pecho","espalda") NOT NULL,
  objetivo ENUM('mantenimiento', 'volumen', 'definicion') NOT NULL
);

CREATE TABLE rutinas (
  id INT PRIMARY KEY,
  nombreRutina varchar(30) NOT NULL, 
  diaUno VARCHAR(255) NOT NULL,
  diaDos VARCHAR(255) NOT NULL,
  diaTres VARCHAR(255) NOT NULL,
  diaCuatro VARCHAR(255) NOT NULL,
  diaCinco VARCHAR(255) NOT NULL,
  entrenamiento_id INT NOT NULL,
  FOREIGN KEY (entrenamiento_id) REFERENCES entrenamientos(id)
);

CREATE TABLE planesAlimentarios (
  id INT PRIMARY KEY,
  nombrePlan varchar(30) NOT NULL,
  Lunes VARCHAR(255),
  Martes VARCHAR(255),
  Miercoles VARCHAR(255),
  Jueves VARCHAR(255),
  Viernes VARCHAR(255),
  Sabado VARCHAR(255),
  Domingo VARCHAR(255)
);

CREATE TABLE cliente_rutina (
  id INT PRIMARY KEY,
  idCliente INT NOT NULL,
  idRutina INT NOT NULL,
  FOREIGN KEY (idCliente) REFERENCES cliente(id),
  FOREIGN KEY (idRutina) REFERENCES rutinas(id)
);

CREATE TABLE planesAlimentarios_comidas (
  plan_id INT NOT NULL,
  comida_id INT NOT NULL,
  PRIMARY KEY (plan_id, comida_id),
  FOREIGN KEY (plan_id) REFERENCES planesAlimentarios(id),
  FOREIGN KEY (comida_id) REFERENCES comidas(id)
);

CREATE TABLE cliente_planesAlimentarios (
  id INT PRIMARY KEY,
  idCliente INT NOT NULL,
  idPlanAlimentario INT NOT NULL,
  FOREIGN KEY (idCliente) REFERENCES cliente(id),
  FOREIGN KEY (idPlanAlimentario) REFERENCES planesAlimentarios(id)
);

CREATE TABLE anuncios (
  id INT PRIMARY KEY auto_increment,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT NOT NULL,
  fecha DATE NOT NULL,
  empleado_id INT NOT NULL,
  FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);
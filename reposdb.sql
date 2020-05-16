CREATE DATABASE repos;

USE repos;

/* Creación de la tabla asesor */
/* nombre, email, uid, picture, departamento, telefono, rol */
CREATE TABLE asesor ( uid varchar(50) PRIMARY KEY NOT NULL, nombre varchar(100) NOT NULL,
	email varchar(30) NOT NULL, picture varchar(200) NOT NULL,
	departamento varchar(50) NOT NULL, telefono varchar(50) NOT NULL, rol varchar(20) NOT NULL  );

/* Creación de la tabla alumno */
/* nombre, email, uid, picture, username, no_control, rol */
CREATE TABLE alumno ( uid varchar(50) PRIMARY KEY NOT NULL, nombre varchar(100) NOT NULL,
	email varchar(30) NOT NULL, picture varchar(200) NOT NULL,
	username varchar(50) NOT NULL, no_control varchar(50) NOT NULL, rol varchar(20) NOT NULL  );


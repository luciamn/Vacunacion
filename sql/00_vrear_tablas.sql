--Accede a la BD de quevedodb
USE quevedodb;


CREATE TABLE usuarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR (255) NOT NULL,
	apellidos VARCHAR (255) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
	DNI VARCHAR (255) NOT NULL,
    password VARCHAR (255) NOT NULL
);

CREATE TABLE vacuna (
                        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(20) NOT NULL,
                        nombre_largo VARCHAR(100) NOT NULL,
                        fabricante VARCHAR(255) NOT NULL,
                        num_dosis INT(10) NOT NULL,
                        tiempo_minimo INT,
                        tiempo_maximo INT
);
CREATE TABLE cita(
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    CIPA VARCHAR(255) NOT NULL,
    fechadenacimiento DATETIME DEFAULT  CURRENT_TIMESTAMP,
    fechacitacion DATETIME DEFAULT  CURRENT_TIMESTAMP,
    localizacion VARCHAR(255) NOT NULL,
    vacuna VARCHAR(255) NOT NULL,
    CONSTRAINT usuario_cita_fk FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
);
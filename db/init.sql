-- Archivo: /database/init.sql

CREATE DATABASE IF NOT EXISTS dataphp;
USE dataphp;

-- Tabla de cuentas (login/registro)
CREATE TABLE cuenta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL CHECK (CHAR_LENGTH(contrasena) >= 15),
    role ENUM('aspirante', 'rh') DEFAULT 'aspirante',
    creadoEn TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT FALSE;
    token VARCHAR(50) NULL
);

-- Tabla de datos personales
CREATE TABLE datos_personales(
     id INT AUTO_INCREMENT PRIMARY KEY,
     residencia VARCHAR(150) NOT NULL,
     nacionalidad VARCHAR(50) NOT NULL,
     estado_civil VARCHAR(50) NOT NULL,
     genero VARCHAR(10) NOT NULL,
     tipo_sangre VARCHAR(5) NOT NULL,
);

-- Tabla de aspirantes
CREATE TABLE aspirante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cuenta_id INT NOT NULL,
    datos_id INT NOT NULL,
    cedula_pasaporte VARCHAR(50) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    FOREIGN KEY (cuenta_id) REFERENCES cuenta(id) ON DELETE CASCADE
    FOREIGN KEY (datos_id) REFERENCES datos_personales(id) ON DELETE CASCADE
);


-- Tabla de solicitudes
CREATE TABLE solicitudes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aspirante_id INT NOT NULL,
    estado ENUM('no considerado', 'no revisado', 'considerado') DEFAULT 'no revisado',
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (aspirante_id) REFERENCES aspirante(id) ON DELETE CASCADE
);

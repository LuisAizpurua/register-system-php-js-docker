-- Archivo: /database/init.sql

CREATE DATABASE IF NOT EXISTS registro_rrhh;
USE registro_rrhh;

-- Tabla de cuentas (login/registro)
CREATE TABLE cuentas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) UNIQUE NOT NULL,
    contrasena_hash VARCHAR(255) NOT NULL,
    rol ENUM('aspirante', 'rh') DEFAULT 'aspirante',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de aspirantes con datos personales
CREATE TABLE aspirantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cuenta_id INT NOT NULL,
    cedula_pasaporte VARCHAR(50) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    estado_civil VARCHAR(50) NOT NULL,
    genero VARCHAR(10) NOT NULL,
    tipo_sangre VARCHAR(5) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    nacionalidad VARCHAR(50) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    residencia VARCHAR(150) NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL,
    FOREIGN KEY (cuenta_id) REFERENCES cuentas(id) ON DELETE CASCADE
);

-- Tabla de solicitudes
CREATE TABLE solicitudes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aspirante_id INT NOT NULL,
    estado ENUM('no considerado', 'no revisado', 'considerado') DEFAULT 'no revisado',
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (aspirante_id) REFERENCES aspirantes(id) ON DELETE CASCADE
);

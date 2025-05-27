# 📋 Proyecto Final - Sistema de Registro RH con PHP

Este es el proyecto final del equipo, desarrollado como una aplicación web simple para el registro de personal en Recursos Humanos. Se utiliza PHP para el backend, HTML/CSS para el frontend y MySQL para la base de datos.

---

## 🧩 Módulos del Proyecto

| Módulo           | Encargado | Descripción                                         |
|------------------|-----------|-----------------------------------------------------|
| **Módulo 1**     | Oscar     | Registro y Login (autenticación de usuarios)       |
| **Módulo 2**     | Alex      | Formulario de ingreso de datos (registro de personal) |
| **Módulo 3**     | Danny     | Base de datos: diseño seguro y conexión            |
| **Módulo 4**     | Moisés    | Validaciones, seguridad y procesamiento de datos   |

---

## 📁 Estructura del Proyecto

```plaintext
registro-rh-php/
├── db/
│   └── init.sql               # Script de base de datos
├── src/
│   ├── auth/                  # Lógica de login y registro
│   ├── views/                 # Formularios e interfaces HTML
│   └── controllers/           # Lógica PHP para formularios y validaciones
├── assets/                    # Estilos, imágenes, scripts JS
├── README.md                  # Documento principal del proyecto
└── index.php                  # Página principal


🧠 Requisitos
PHP 7.4+

MySQL/MariaDB

Servidor local (XAMPP, Laragon, WAMP, etc.)

Navegador web

Git (para control de versiones)

⚙️ Instalación Local
1.Clona el repositorio:

git clone https://github.com/tuusuario/registro-rh-php.git
cd registro-rh-php

2.Importa el archivo db/init.sql en tu base de datos (usa phpMyAdmin o consola MySQL).

3.Configura la conexión a la base de datos en el archivo PHP correspondiente (db.php o similar).

4.Inicia tu servidor local (XAMPP o similar) y abre en tu navegador:
http://localhost/registro-rh-php


🔄 Flujo de trabajo con Git + Linear

1. Clona el proyecto:

git clone https://github.com/tuusuario/registro-rh-php.git
cd registro-rh-php

2. Crea una nueva rama para tu módulo:

git checkout -b modulo-3-db


3. Agrega tus cambios:

git add .

4. Haz un commit vinculado a una tarea de Linear:

git commit -m "Crear script de base de datos inicial [linear:ISSUE-ID]"

5. Sube tu rama:
git push origin modulo-3-db

✅ Buenas prácticas
Haz commits claros: Agregar validación de sesión, Formulario de ingreso listo, etc.

Relaciona cada commit con su tarea en Linear usando [linear:ID].

Haz pull requests cuando termines tu parte para revisión del equipo.

👥 Integrantes del Equipo

Oscar – Módulo 1: Login y Registro

Alex – Módulo 2: Formulario de Registro

Danny – Módulo 3: Base de Datos (script y conexión)

Moisés – Módulo 4: Seguridad y validaciones

🛡️ Seguridad

Las contraseñas están encriptadas con password_hash() en PHP.

Se validan los formularios del lado del servidor para evitar inyecciones SQL.

Se usan conexiones seguras a la base de datos (PDO o MySQLi con prepared statements).

📌 Notas Finales
El proyecto puede crecer fácilmente para incluir roles de usuario, reportes o más módulos.

Si deseas contribuir o probar nuevas funciones, crea una rama y solicita un Pull Request.

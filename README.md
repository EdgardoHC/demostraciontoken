**Ejecutar**
composer require firebase/php-jwt

**Crear una base de datos**

CREATE DATABASE auth_demo;
USE auth_demo;
 
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
  
**Usando curl en windows**

curl -X POST http://localhost/demostraciontoken/api/register ^
-H "Content-Type: application/json" ^
-d "{\"email\":\"edgardo@ejemplo.com\", \"password\":\"123457\"}"
 
 
curl -X POST http://localhost/demostraciontoken/api/login ^
-H "Content-Type: application/json" ^
-d "{\"email\":\"edgardo@ejemplo.com\", \"password\":\"123457\"}"
 
 
Es un encabezado HTTP que se usa para enviar un token de 
autenticación a un servidor, normalmente en APIs protegidas 
por JWT u otros sistemas de autenticación basada en tokens.
"El portador de este token tiene acceso autorizado."
 
curl -X GET http://localhost/demostraciontoken/api/protected ^
-H "Authorization: Bearer SU_TOKEN"

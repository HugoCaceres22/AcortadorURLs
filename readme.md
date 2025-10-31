🌐 DNS URL Shortener

Este proyecto consiste en crear un acortador de URLs utilizando registros DNS TXT en lugar de bases de datos o servicios web tradicionales.
Cada URL larga se guarda como texto dentro de un registro TXT del dominio, permitiendo que el propio DNS actúe como sistema de redirección.

🚀 Objetivo de la práctica

Aprender a usar el DNS como un sistema de almacenamiento distribuido para crear enlaces cortos totalmente personalizados.
El proyecto combina conceptos de redes, programación y automatización con APIs.

🧠 Qué se aprende

Funcionamiento de los registros DNS TXT.

Uso de la API de IONOS para crear registros de forma automática.

Generación de hashes únicos (MD5 o SHA256) para las URLs.

Validación de URLs desde un formulario web.

Resolución de registros DNS con scripts o herramientas como dig.

Creación de un cliente o API que redirige al enlace original.

⚙️ Funcionamiento general

El usuario introduce una URL larga.

Se valida y se genera un hash corto.

Se comprueba si existe un registro TXT en el DNS.

Si no existe, se crea mediante la API de IONOS.

El cliente o script consulta el registro TXT y redirige al destino real.
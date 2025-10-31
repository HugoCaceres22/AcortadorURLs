# **DNS URL Shortener**

Este proyecto consiste en crear un **acortador de URLs utilizando registros DNS TXT** en lugar de bases de datos o servicios web tradicionales.  
Cada URL larga se guarda como texto dentro de un **registro TXT** del dominio, permitiendo que el propio DNS actúe como un sistema de redirección.

---

## **Objetivo de la práctica**

Aprender a usar el **DNS como un sistema de almacenamiento distribuido** para crear enlaces cortos totalmente personalizados.  
El proyecto combina conceptos de **redes**, **programación** y **automatización mediante APIs**.

---

## **Qué se aprende**

- Funcionamiento de los **registros DNS TXT**.  
- Uso de la **API de IONOS** para crear registros automáticamente.  
- Generación de **hashes únicos** (*MD5* o *SHA256*) para las URLs.  
- Validación de URLs mediante un **formulario web**.  
- Consulta de registros DNS con herramientas como **`dig`** o scripts personalizados.  
- Creación de un **cliente o API web** que redirige al enlace original.

---

## **Funcionamiento general**

1. El usuario introduce una **URL larga**.  
2. Se valida y se genera un **hash corto**.  
3. Se comprueba si existe un **registro TXT** correspondiente en el DNS.  
4. Si no existe, se crea mediante la **API de IONOS**.  
5. El cliente o script consulta el **registro TXT** y redirige al destino real.
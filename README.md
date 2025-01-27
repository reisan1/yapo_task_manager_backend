# Proyecto Yapo Task Manager

Este proyecto fue hecho con cariño como prueba para yapo.cl.

## Instrucciones

### Crear un servidor de bases de datos de pruebas

En la carpeta `docker`, ejecute el siguiente comando (Debe tener instalado Docker, Docker Compose y PHP):

```sh
docker compose up -d
```

### Poblar la base de datos

1. Configure su archivo `.env` descomentando las líneas correspondientes a `localhost`.
2. En la carpeta de la API, ejecute los siguientes comandos:

```sh
php artisan migrate
php artisan db:seed
```

### Lanzar el servidor local

Ejecute el siguiente comando en su terminal preferida, situado en la carpeta de este archivo:

```sh
php -S localhost:8000 -t public
```

¡Gracias por leer!
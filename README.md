Este proyecto fue hecho con cariño como prueba para yapo.cl.

- Para crear un servidor de bases de datos de pruebas, en la carpeta docker, ejecute el siguiente comando docker (Debe tener instalado docker, docker compose y php:) 
* docker compose up -d 

- Para poblar la base de datos, debe configurar su .env otorgado descomentando las lineas correspondientes a localhost y luego, en la carpeta de la api ejecute los siguientes comandos:
* php artisan migrate
* php artisan db:seed

- Para lanzar el servidor local, ejecute el siguiente comando en su terminal preferida, situado en la carpeta de este archivo:
* php -S localhost:8000 -t public

¡Gracias por leer!
# Despliegue de Color Bakery

Este repositorio contiene los pasos necesarios para desplegar el sistema "Talent.Code".

## Prerrequisitos

Antes de comenzar, asegúrate de tener instalados los siguientes elementos:

- [Docker](https://www.docker.com/get-started)
- [Git](https://git-scm.com/)

## Pasos para el despliegue

1. Crea un directorio llamado 'talent.code' y coloca este fichero 'docker-compose.yml' en él:

    ```bash
    mkdir talent.code
    cd talent.code
    ```

2. Clona el repositorio del backend:

    ```bash
    git clone https://github.com/DeboraMed/proyecto-final-daw-laravel backend
    ```

3. Clona el repositorio del frontend:

    ```bash
    git clone https://github.com/DeboraMed/proyecto-final-daw frontend
    ```

4. Levanta los contenedores Docker:

    ```bash
    sudo docker compose up -d --build
    ```

5. Por último, ejecutaremos las migraciones de la base de datos, desde el contenedor del backend. Incluyendo "--seed" podemos generar datos de prueba. (Si es necesario, ajusta los nombres de los contenedores Docker según tu configuración.):

    ```bash
    sudo docker exec talentcode-backend-1 php artisan migrate:fresh --seed
    ```

## Cómo probar la herramienta

1. Una vez que los contenedores están en ejecución, accede a la aplicación desde tu navegador web en la siguiente dirección:

    ```
    http://localhost:5173
    ```

2. Utiliza las siguientes credenciales para iniciar sesión como un usuario de tipo 'desarrollador':

    - Email: dev@test.com
    - Contraseña: dev_password

3. Utiliza las siguientes credenciales para iniciar sesión como un usuario de tipo 'empresa':

    - Email: comp@test.com
    - Contraseña: comp_password

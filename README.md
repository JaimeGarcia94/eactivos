1. Descargar el repositorio de gitHub en una nueva carpeta

2. Importar el fichero "eactivos.sql" a cualquier motor de base de datos (en mi caso he utilizado heidiSQL). Recalcar que el fichero ya crea toda la
estructura con un usuario de pruebas y un administrador.

3. Revisar que los puertos estén libres:
    
    NGINX: "8080:80"
    CONTAINER-APP: "9000:9000"
    MYSQL: "33069:3306" 

4. Construir/levantar los contenedores de docker con: docker-compose up -d --build

5. Acceder al navegador con la url: http://localhost:8080/login
 


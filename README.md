# Servicio Social

<img src="docs/img/login.png">

## Instalación - Desarrollo

### Dependencias
* `node >= 16.0.0`
* `npm`
* `php >= 8.0`
* `php-xml`
* `php-curl`
* `composer`
* `docker`
---


1. Clonar repositorio

  ```sh
  git clone https://github.com/LuisQuintana23/servicio-social.git
  cd servicio-social
  ```
2. Cambia a la rama de desarrollo
  ```sh
  git switch develop
  ```

3. Instala dependencias del proyecto
  ```sh
  composer install
  npm install
  ```

4. Configura el archivo de configuracion `.env` o simplemente copia y pega `.env.example`
  ```sh
  cp .env.example .env
  ```

5. Inicia los contenedores con `sail`
  ```sh
  ./vendor/bin/sail up
  ```
> _NOTA_: Agrega un alias para ejecutar solo ``sail`` y no la ruta completa ``./vendor/bin/sail up``

6. Ejecuta las migraciones
  ```sh
  sail artisan migrate --seed
  ```

7. Inicia el servidor de desarrollo de `vite`
  ```sh
  npm run dev
  ```
* Si no se está realizando desarrollo front-end ejecuta `npm run build`
* En caso de que vite no cargue los estilos limpiar el cache
* Si se cambia alguna ruta ejecutar `sail artisan route:cache`

## Uso de Git Flow

1. Instalar gitflow desde el siguiente [repositorio](https://github.com/nvie/gitflow#git-flow) y ejecutar
  ```
  git flow -d
  ```
2. Cada que se inicia una funcionalidad ejecutar un feature de git flow
  ```
  git flow feature start <nombre_funcionalidad>
  ```
3. Realizar commits con normalidad hasta que la funcionalidad sea estable, para finalizar la
rama y realizar un merge con la rama develop utilizar
  ```
  git flow feature finish <nombre_funcionalidad>
  ```

4. Cuando se esté seguro de los cambios realizar un push
  ```
  git push
  ```

[Más información](https://www.atlassian.com/es/git/tutorials/comparing-workflows/gitflow-workflow)


## Q&A :question::question:

### laravel.test port is already in use
Verificar que el puerto 80 no este siendo usado por otro servicio
por lo regular en algunas distribuciones al instalar php tambien
se instala apache2 y este usa el puerto 80 por lo que es necesario cambiarlo
o desinstalarlo

### mysql exit code 1, archivos corruptos
Si al iniciar los contenedores de docker, mysql no se ha iniciado
se deben ejecutar los sigueintes comandos. Esto comunmente sucede
por apagar los servicios abruptamente
```sh
sail stop
sail down
docker images rmi <imagen-mysql>
docker volume rm <volumen-mysql>
sail up
```
[Fuente](https://stackoverflow.com/questions/73217146/mysql-container-keep-not-connecting-to-my-container)

### npm run dev error al ejecutarse en la sentencia await
Verificar que se tenga instalador `node >= 16.0.0`, en caso
contrario actualizarlo con
```sh
sudo npm install -g n
n lts
node -v
```
> En caso de no poder ejecutar n con sudo, reiniciar el sistema



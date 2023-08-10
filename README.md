# Servicio Social

## Instalación - Desarrollo

### Dependencias
* `node`
    * `npm`
* `php`
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
_NOTA_: Agrega un alias para ejecutar solo ``sail`` y no la ruta completa ``./vendor/bin/sail up``

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

### Uso de Git Flow

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






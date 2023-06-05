# Servicio Social

## Instalación - Desarrollo

### Dependencias
* `npm`
* `node`
* `php`
* `composer`
* `docker`
---

1. Clonar repositorio

  ```sh
  git clone https://github.com/LuisQuintana23/servicio-social.git
  cd servicio-social
  ```

2. Agrega el directorio `vendor` con `composer` (se puede obtener de manera externa copiando y pegando vendor/ de algún proyecto laravel)
  ```sh
  composer install
  ```

3. Instala los modulos de `npm`
  ```sh
  npm install
  ```

4. Configura el archivo de configuracion `.env`

5. Inicia los contenedores con `sail`
  ```sh
  ./vendor/bin/sail up
  ```
_NOTA_: Agrega un alias para ejecutar solo ``sail`` y no la ruta completa ``./vendor/bin/sail up``

6. Ejecuta las migraciones
  ```sh
  sail artisan migrate:fresh --seed
  ```

7. Inicia el servidor de desarrollo de `vite`
  ```sh
  npm run dev
  ```
* Si no se está realizando desarrollo front-end ejecuta `npm run build`
* En caso de que vite no cargue los estilos limpiar el cache


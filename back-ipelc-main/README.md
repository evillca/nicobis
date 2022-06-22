# BackEnd-Laravel 8.x
BackEnd Biblioteca Instituto Plurianual de Estudio de Lenguas y Cultura
-----
## Requisitos

Antes de intentar publicar tu aplicación en un servicio de alojamiento, necesitas asegurarte de que cumple con los [requisitos de Laravel](https://laravel.com/docs/5.2#server-requirements). Básicamente, Laravel `8.x` necesita:

- PHP >= `8.0.x`
- Composer
- npm

-----
<a name="item2"></a>

## Inicio:

```bash
 $ cd nombre_proyecto
```

* [Paso 1: Ejecutar los siguientes comandos](#step1)
```bash
 $ composer install
 $ npm install
```
* [Paso 2: Ejecutar los siguientes comandos](#step1)
### Laravel
Copiar `.env.example` to `.env`

```
Editar archivo `.env`
```
Cargar los valores de conexion de `DB_*` segun las credenciales.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=myapp
DB_USERNAME=myapp
DB_PASSWORD=xxxxx
```
<!-- Change `APP_ENV=local` to `APP_ENV=production` (you could disable debug too). -->

Generar el key para laravel:
```bash
$ php artisan key:generate
```
Correr migraciones, para generar tablas por defecto de laravel
```bash
$ php artisan migrate
$ php artisan db:seed
```

Comandos de Actualización de librerias
```bash

$ composer install

Eliminar carpetas storage, portadas, uploads de la carpeta /public (en el caso que esten creados)

$ php artisan storage:link
```

Configuración para almacenar Archivos en el servidor local y un servior externo.
Editar archivo `.env`

```bash
Para guardado local
FILESYSTEM_DRIVER=local


Para guardado externo

FILESYSTEM_DRIVER=sftp

EXT_HOST=MyHost
EXT_USERNAME=Usuario
EXT_PASSWORD=Pass
DIR_PATH_TO_WHERE_FILE_STORE=/ruta_almacenamiento_de_archivos/

API_DOMINIO_ARCHIVOS=ruta_publica_de_acceso_a_los_archivos/

```
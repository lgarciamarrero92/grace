
## About Grace

Software para Gestión de resultados académicos, científicos y extensionistas en universidades

## Install

Clonar el repositorio e instalar dependencias
```bash
composer install
npm install
```
Correr migraciones y seeders
```bash
php artisan migrate
php artisan db:seed
```
Crear usuario administrador
```bash
php artisan voyager:admin your@email.com (si ya existe el usuario your@email.com)
php artisan voyager:admin your@email.com --create (para crear un nuevo admin)
```
## License

Grace is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

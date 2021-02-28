
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
## Documentation
### Form Fields
#### Combobox (details)
```bash
{
    "validation": {
        "rule": "required|array|min:1|max:10" //Validation rules
    },
    "options": ["Option1","Option2"],//In case of static options manually
    "options-api": "/api/users",//In case of static options fetched from api
    "search-api": "/api/users/search",//In case of dynamic options fetched from api, api has to receive a parameter `query`
    "type": "user",//Type of data input [user,tag] etc
    "save_as_category": {
        "tutorias": "titulacion-academica"
    },//An user in this data input with category `tutorias` will be saved as `titulacion-academica`, this is for multiuser categories
    "private": true //If is only visible for auth user
}
```
## License

Grace is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

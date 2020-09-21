# Installation
## Server Requirements
Because this is made with the Laravel, Server Requirements the same as that. [Please Read](https://laravel.com/docs/7.x/installation#server-requirements)

## Installing CRUD Generator
After you get the Source Code, extract it and open it in the terminal.
```bash
cd crud-project
```
Then install all package dependencies with the **composer**
```bash
composer install
```
Make sure all dependencies are installed, copy the ```.env.example``` to ```.env``` and after that edit the database configuration in the ```.env``` file, for example :
```bash
#DB Section
DB_CONNECTION=pgsql #mysql,sqlsrv,sqlite
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=truscrud
DB_USERNAME=root
DB_PASSWORD=root
```

!>SQLite is not stable, maybe some page get errors

Run database migrate with seeder
```bash
php artisan migrate --seed
```
Run development server
```bash
php artisan serve --port=3000
```
!> You can login with default account: </br>
email : admin@mail.com / password: password
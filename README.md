System Configutation
Compser 2.3.9
PHP 8.3.6 
Laravel 12
Node v22.12
NPM 10.9

1) Create a fresh laravel project

2) Setup database connection in .env file

3) Install laravel Breeze usign commands
    composer require laravel/breeze --dev
    php artisan breeze:install
    npm install
    npm run build

4) Update seeder file for admin user
   Create factory and seeder for company dummy data
   php artisan make:factory CompanyFactory
   php artisan make:seeder CompanySeeder

5) Make Company CRUD.
   create model, controller, migration using command
   php artisan make:model Company -crm

6) Make Employee CRUD.
   create model, controller, migratiom using command
   php artisan make:model Employee -crm
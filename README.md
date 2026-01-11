# Mini CRM - Laravel Application

A Simple Relationship management system for managing companies and employees built with laravel 12.


System Configutation
Compser
PHP >= 8.2
MySql 
Node
NPM

# Installation Steps
1) Download the project Or Clone from github URL

2) Install the PHP Dependencies 
   ->`composer install`

3) Install the JS Dependencies
   ->`npm install`

4) Build Frontend assets
   ->`npm run dev`
   ->`npm run build`

5) Enviroment Configuration
   ->Copy the .env.example file and create the .env file
   ->update the below details as per your system database name, username and password
      DB_DATABASE=mini_crm
      DB_USERNAME=your_database_username
      DB_PASSWORD=your_password

6) Create a Database `mini_crm` in your MySql

7) Run Migration & Seed the admin user credentials 
   ->`php artisan migrate --seed`
   Credentials:
      email: admin@admin.com
      password: password

8) Create Storage Symbolic link
   ->`php artisan storage:link`
      This links `storage/app/public` to `public/storage` for file access.

9) Start the development server
   ->`php artisan serve`

## Project Structure

mini-crm/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CompanyController.php
│   │   │   |── EmployeeController.php
│   │   |── Requests/
│   │       ├── CompanyRequest.php
│   │       |── EmployeeRequest.php
│   |── Models/
│   |   |── Company.php
│   |   |── Employee.php
|   |── Repositories/
|   |   |── Interfaces
|   |   |   |── CompanyRepositoryInterface
|   |   |   |── EmployeeRepositoryInterface
|   |   |── CompanyRepository
|   |   |── EmployeeRepository

├── database/
│   ├── migrations/
│   │   ├── xxxx_create_companies_table.php
│   │   ├── xxxx_create_employees_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
├── resources/
│   ├── views/
│       ├── companies/
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── index.blade.php
│       │   ├── show.blade.php
│       ├── employees/
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── index.blade.php
│       │   ├── show.blade.php
│       └── dashboard.blade.php
├── routes/
│   ├── web.php
└── storage/
    ├── app/
        ├── public/
            ├── logos/
            ├── profile_pictures/


## Validation Rules

### Company
- **Name**: Required, max 255 characters
- **Email**: Optional, valid email format
- **Logo**: Optional, image, minimum 100x100 pixels
- **Website**: Optional, valid URL

### Employee
- **First Name**: Required, max 255 characters
- **Last Name**: Required, max 255 characters
- **Company**: Required, must exist in companies table
- **Email**: Optional, valid email format
- **Phone**: Optional, max 12 numerics
- **Profile Picture**: Optional, image (png/jpeg), max 1MB

## Database Schema

### Companies Table
- id (Primary Key)
- name (Required)
- email (Nullable, unique)
- logo (Nullable)
- website (Nullable)
- timestamps

### Employees Table
- id (Primary Key)
- first_name (Required)
- last_name (Required)
- company_id (Foreign Key → companies.id)
- email (Nullable, unique)
- phone (Nullable)
- profile_picture (Nullable)
- timestamps

## Troubleshooting

### Storage Link Issue
If images don't display, ensure the storage link exists:
   `php artisan storage:link`

### Permission Issues (Linux)
   `chmod -R 775 storage bootstrap/cache`
   `chown -R www-data:www-data storage bootstrap/cache`


### Database Connection Error
- Verify database credentials in `.env`
- Ensure MySQL server is running
- Check if database exists

### Migration Issues
Reset and re-migrate:
   `php artisan migrate:fresh --seed`

---

## Testing the Application

### Test Companies Module
1. Login as admin
2. Go to Companies
3. Click "Add New Company"
4. Fill in required fields (Name is required)
5. Upload a logo (minimum 100x100px)
6. View, Edit, and Delete companies

### Test Employees Module
1. First create at least one company
2. Go to Employees
3. Click "Add New Employee"
4. Fill in required fields (First Name, Last Name, Company)
5. Upload a profile picture (PNG/JPEG, max 1MB)
6. View, Edit, and Delete employees
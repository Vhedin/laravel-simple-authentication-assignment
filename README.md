## About the Assessment

This assessment evaluates your comprehension of PHP design principles and their practical application within the Laravel framework. The tasks are structured across three levels, each progressively building upon the knowledge and skills demonstrated in the preceding one.

The key features of this project include:

-   **Authentication:** Utilizing Laravel's built-in authentication system.
-   **Login Feature:** The project exclusively focuses on the login functionality, with registration and other features not included in this assessment.
-   **User Management:** Post-login, user management encompasses operations such as creating, reading, updating, deleting, trashing, and restoring user records.
-   **Profile Updates:** Limited implementation of profile update functionality.

The project utilizes the latest version of Laravel (v11.x).

## Requirements

To work with this project, ensure the following prerequisites are met:

-   **Minimum PHP Version:** PHP 8.2 or higher.
-   **Composer:** Dependency management for PHP.
-   **Database:** Supports various database systems such as MySQL, SQLite, MariaDB, PostgreSQL, etc.
-   **Git:** Version control system for tracking changes in the project.

## Installation Process

### Step 1: Clone This app

Clone the project repository by running the following command in your terminal:

```bash
git clone https://github.com/iqbalhasandev/laravel-simple-authentication-assignment.git
```

### Step 2: Go To project directory and composer install

Navigate into the project directory:

```bash
cd laravel-simple-authentication-assignment
```

Copy the .env.example file to .env:

```bash
cp .env.example .env
```

Then, install Composer dependencies:

```bash
composer install
```

### Step 3: Configure Environment Variables

Open the .env file and configure the following variables:

```php
APP_URL=http://127.0.0.1:8000/
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Replace the values according to your local environment settings, such as the database connection details.

### Step 4: Publish Storage

Publish the storage using the following command:

```bash
php artisan storage:link
```

### Step 5: Generate Application Key

Generate the application key by running:

```bash
php artisan key:generate
```

### Step 6: Run Migration and Seeder

To set up the database schema and seed it with default data, execute the migration and seeding commands:

```bash
php artisan migrate --seed
```

This command will run all outstanding migrations and seed the database with default data. In this case, it will create a default user with the following credentials:

-   **Email:** admin@gmail.com
-   **Password:** password

You can use these credentials to log in and explore the application.

### Step 7: Run Tests

Execute the test suite to ensure everything is set up correctly:

```bash
php artisan test
```

### Step 8: Serve the Application

Finally, serve the application using the following command:

```bash
 php artisan serve
```

## Additional Notes

If you encounter any permission-related errors during the installation process, you can recursively adjust the permissions of the storage and bootstrap directories using the following command:

```bash
chmod -R 755 storage bootstrap
```

## Contact Information

For further assistance or inquiries, you can reach out to:

-   [My Portfolio](https://iqbalhasan.dev)

-   [My Blog](https://iqbalhasan.dev)

Thank you for visiting!

# CRUD Application for Products

This is a simple CRUD (Create, Read, Update, Delete) application built using PHP and MySQLi to manage products attached to each user.

## Features

- User registration and login
- User authentication using sessions
- Product creation, read, update, and delete operations
- Responsive design using Bootstrap 4
- Display products as a carousel for non-logged-in users

## Requirements

- PHP 5.5 or later
- MySQL 5.6 or later
- Web server (e.g. Apache, Nginx)

## Installation

1. Clone the repository to your local machine:

    ```bash
    git clone https://github.com/your-username/crud-application.git
    ```

2. Import the `database.sql` file into your MySQL server to create the database and the required tables.

3. Update the database credentials in the `database.php` file to match your MySQL server:

    ```php
    $mysqli = new mysqli("localhost", "username", "password", "database_name");
    ```

4. Start the web server and navigate to the application URL to use the CRUD application.

## Usage

1. Navigate to the index page to view the list of products.

2. If you're not logged in, the products will be displayed as a carousel. If you're logged in, you will see a table with the product information.

3. Click on the "Register" link to create a new user account.

4. After registering, log in using your email and password.

5. Once you're logged in, you can create, edit, and delete products.

6. Click on the "Logout" link to log out of the application.

## Credits

- Bootstrap 4
- jQuery
- MySQLi

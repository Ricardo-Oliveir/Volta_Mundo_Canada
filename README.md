# Volta ao Mundo - Canada: A Simple PHP Website

## Description

"Volta ao Mundo - Canada" is a PHP-based website designed to showcase information about Canada, focusing on its tourism and gastronomy. It features a user commenting system allowing visitors to share their thoughts and optionally upload images. An administrative panel is available for registered users to manage and moderate these comments.

## Features

*   View articles and information on Canadian tourism and gastronomy (currently static HTML pages).
*   User comment submission with optional image uploads.
*   Admin panel for approving and deleting comments.
*   User registration and login system for administrators.
*   Session-based flash messages for user feedback.
*   CSRF protection for sensitive actions in the admin panel.

## Setup Instructions

To set up and run this project locally, follow these steps:

1.  **Clone the Repository:**
    ```bash
    git clone <repository_url>
    cd Volta_Mundo_Canada 
    ```
    (Replace `<repository_url>` with the actual URL of this repository).

2.  **Prerequisites:**
    *   Ensure you have a web server installed (e.g., Apache, Nginx) with PHP support.
    *   Ensure you have a MySQL database server installed and running.

3.  **Database Configuration:**
    *   In the project root, you will find a file named `db_config.php.template`.
    *   Create a copy of this file and name it `db_config.php`.
    *   **Important:** Move this `db_config.php` file to a directory **one level above** your project's web root directory. For example, if your project is served from `/var/www/html/Volta_Mundo_Canada`, place `db_config.php` in `/var/www/html/`. This is a security measure to keep your database credentials outside the publicly accessible web root.
    *   Edit the `../db_config.php` (relative to the project's PHP scripts) with your actual database server name, username, password, and the name of the database you want to use for this project.
        ```php
        <?php
        // Database configuration
        // Rename this file to db_config.php and place it one level above your web root directory.
        // Then, fill in your actual database credentials.

        define('DB_SERVERNAME', 'your_server_name'); // e.g., 'localhost'
        define('DB_USERNAME', 'your_username');
        define('DB_PASSWORD', 'your_password');
        define('DB_NAME', 'your_database_name');
        ?>
        ```

4.  **Database Schema:**
    The project requires the following tables. You may need to create them manually in your database using a tool like phpMyAdmin or the MySQL command line.

    *   **`users` table:**
        ```sql
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        );
        ```

    *   **`comments` table:**
        ```sql
        CREATE TABLE comments (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            comment TEXT NOT NULL,
            image_path VARCHAR(255) NULL,
            image BLOB NULL, -- Deprecated: Used for older comments, new ones use image_path
            approved TINYINT(1) DEFAULT 0, -- 0 = pending, 1 = approved
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        ```
        *(Note: The `image` BLOB column is largely deprecated in favor of `image_path` but is included for reference if adapting from an older state.)*

5.  **Image Uploads Directory:**
    *   In the project root directory (e.g., `Volta_Mundo_Canada/`), create a directory named `uploads`.
    *   Inside the `uploads` directory, create another directory named `images`. The final path should be `uploads/images/`.
    *   Ensure this `uploads/images/` directory is writable by your web server process. On Linux, you might use commands like:
        ```bash
        mkdir -p uploads/images
        sudo chmod 755 uploads/images 
        # Or, more securely, change ownership to the web server user (e.g., www-data for Apache on Debian/Ubuntu)
        # sudo chown www-data:www-data uploads/images 
        ```
        Consult your web server's documentation for the correct user if needed.

6.  **Access the Project:**
    *   Place the project files in your web server's document root (e.g., `/var/www/html/Volta_Mundo_Canada`).
    *   Open your web browser and navigate to the project's URL (e.g., `http://localhost/Volta_Mundo_Canada/`).

## Security Notes

*   **Database Configuration:** The `db_config.php` file containing database credentials is intentionally placed outside the web document root to prevent direct browser access.
*   **CSRF Protection:** Cross-Site Request Forgery (CSRF) tokens are used to protect actions in the comment management panel (approve/delete comments).
*   **Password Hashing:** User passwords for the admin panel are hashed using `password_hash()` before being stored in the database.
*   **Input Sanitization:** `htmlspecialchars()` is used to sanitize user inputs before display or database insertion to mitigate XSS risks. Server-side validation is also implemented for key inputs.

---
This README provides a basic guide. Depending on your specific server setup, minor adjustments might be necessary.

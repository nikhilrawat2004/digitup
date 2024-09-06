# DigItUp - Food Ordering Platform

DigItUp is a simple and efficient food ordering platform built using HTML, CSS, JavaScript, PHP, and MySQL. It allows users to browse, select, and order meals from various restaurants. It also provides an admin interface to manage menu items and orders.

## Features

- **User-Friendly Interface**: Easy navigation for customers to browse food items.
- **Menu Management**: Admin panel to add, update, and remove menu items.
- **Order Management**: Customers can place orders, and admins can track and update order statuses.
- **Search Functionality**: Search for food items by category, restaurant, or specific dishes.
- **Secure Login**: Separate login portals for customers and administrators.
- **Responsive Design**: Mobile-first approach for easy use on various devices.
- **Database-Driven**: All data is dynamically fetched and stored in a MySQL database.

## Tech Stack

- **Frontend**: 
  - HTML
  - CSS
  - JavaScript

- **Backend**: 
  - PHP

- **Database**: 
  - MySQL

## Setup & Installation

### Prerequisites

- XAMPP/LAMP server (for local development)
- PHP 7.4 or higher
- MySQL 5.7 or higher

### Installation Steps

1. Clone the repository:

   ```bash
   git clone https://github.com/nik-rawat/digitup.git
   cd DigItUp
   ```

2. Import the MySQL database:

   - Open PHPMyAdmin.
   - Create a new database (e.g., `digitup_db`).
   - Import the `digitup_db.sql` file from the `database` folder.

3. Update the database configuration:

   - Navigate to the `config` folder.
   - Edit `db.php` with your database credentials:

     ```php
     $host = 'localhost';
     $user = 'your_username';
     $password = 'your_password';
     $dbname = 'digitup_db';
     ```

4. Start your local server:

   - If you're using XAMPP, start Apache and MySQL.
   - Open your browser and go to `http://localhost/DigItUp`.

### Admin Login

- **URL**: `http://localhost/DigItUp/admin`
- Default credentials:
  - **Username**: `admin`
  - **Password**: `password123`

## Project Structure

```bash
├── assets/            # Images, stylesheets, and JavaScript files
├── config/            # Database connection settings
├── database/          # SQL dump for MySQL
├── admin/             # Admin panel to manage orders and menu
├── includes/          # Reusable PHP components
├── orders/            # Order management for users and admins
├── index.php          # Homepage of the platform
└── README.md          # Project documentation
```

## Contributions

Contributions are welcome! Feel free to fork this repository and submit a pull request. Make sure to discuss any major changes in advance.

## License

This project is licensed under the MIT License. See the `LICENSE` file for more details.

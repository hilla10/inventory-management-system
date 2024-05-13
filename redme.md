# Inventory Management System

This is an inventory management system built using HTML, CSS, Bootstrap, PHP, MySQL. It allows users to manage inventory, different departments, and perform various operations such as login, registration, updating, and deleting records.

## Table of Contents

- [Setup](#setup)
- [Database](#database)
- [Directory Structure](#directory-structure)
- [Running the System](#running-the-system)
- [Login](#login)
- [Functionalities](#functionalities)
- [Troubleshooting](#troubleshooting)
- [Usage](#usage)
- [Security](#security)

## Setup

Before running the system, ensure that you have the following prerequisites installed:

- Web server (e.g., Apache)
- PHP
- MySQL
- you can use WAMP, LAMP, MAMP, XAMP servers

## Database

1. Create a new database named `inventory`.
2. Import the `inventory.sql` from localhost/group-project/database/inventory.sql file into the `inventory` database to create the necessary tables and data.

Directory Structure

    css/ - Contains CSS stylesheets.
    img/ - Stores image assets.
    includes/ - Contains PHP files for reusable components or functions.
    login/ - Contains login files
    index.php - User registration form.
    /delete.php - Handles deletion of records.
    /update.php - Handles updating of records.

Running the System

    Deploy the system on a web server.
    Access the system using the appropriate URL or file path in a web browser.

Login

To access the system, follow these steps:

    Open the group-project/index.php page in a web browser.
    Enter your login credentials.
    username = admin or
    email = admin@gmail.com - you can use username or email
    password = admin@admin123
    Click the "Login" button.

Not: if you have no any credentials you can create.

The inventory management system provides the following functionalities:

    Adding new inventory items.
    Updating existing inventory records.
    Deleting inventory items.
    Managing different departments.
    Generating reports on inventory status.

Troubleshooting

If you encounter any issues while running the system, consider the following tips:

    Ensure that all the necessary software and dependencies are properly installed.
    Double-check the database connection settings in the PHP files.
    Check the server logs for any error messages or warnings.

Usage

To use the inventory management system, follow these steps:

    Register a new user account or use the provided login credentials.
    Navigate through the system's interface to access different functionalities.
    Add or update inventory items, manage departments, and generate reports.
    Make sure to log out after using the system to ensure the security of your account.

Security

When using the inventory management system, consider the following security guidelines:

    - Use strong and unique passwords for your user account.
  
    - Regularly update the system and its dependencies to patch any security vulnerabilities.
  
    - Only provide access to authorized personnel and restrict user privileges based on their roles.

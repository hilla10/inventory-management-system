## Inventory Management System

This Inventory Management System is built using HTML, CSS, Bootstrap, PHP, and MySQL. It enables users to manage inventory, departments, and perform operations such as login, registration, updating, and deleting records.
Table of Contents

[Setup](#Setup)

[Database](#Database)

[Directory Structure](#DirectoryStructure)

[Running the System](#Running-the-System)

[Login](#Login)

[Functionalities](#Functionalities)

[Troubleshooting](#Troubleshooting)

[Usage](#Usage)

[Security](#Security)

## Setup

Before running the system, ensure you have the following prerequisites installed:

    Web server (e.g., Apache)
    PHP
    MySQL
    You can use WAMP, LAMP, MAMP, or XAMP servers.

    download the project file from github after that extract the file 
    and change the folder name to inventory-management-system.

## Database

1. Create a new database named `inventory`.
2. Import the `inventory.sql` from localhost/inventory-management-system/database/inventory.sql file into the `inventory` database to create the necessary tables and data.

## Directory-Structure

    css/: CSS stylesheets.
    img/: Image assets.
    includes/: PHP files for reusable components and functions.
    login/: Login related files.
    index.php: User registration form.
    delete.php: Handles deletion of records.
    update.php: Handles updating of records.

## Running-the-System

    Deployment: Deploy the system on a web server.
    Access: Open the system using the appropriate URL or file path in a web browser.

## Login

To access the system:

    Navigate to inventory-management-system/index.php.
    Use the following credentials:
        Username: admin
        Email: admin@gmail.com (you can use either username or email)
        Password: Admin@Admin123
    Click the "Login" button.

Note: Create new credentials if none exist.
Functionalities

The system includes the following functionalities:

    Adding new inventory items.
    Updating existing inventory records.
    Deleting inventory items.
    Managing different departments.
    Generating reports on inventory status.

## Troubleshooting

If you encounter issues:

    Ensure all required software and dependencies are correctly installed.
    Double-check database connection settings in PHP files.
    Review server logs for error messages or warnings.

## Usage

To use the system:

    Create a new user account or utilize provided login details.
    Navigate through the interface to access various functionalities.
    Add or update inventory items, manage departments, and generate reports.
    Always log out after usage for security.

## Security

When using the system, observe these security guidelines:

    Use strong, unique passwords for user accounts.
    Regularly update system components to address security vulnerabilities.
    Grant system access only to authorized personnel and enforce role-based user privileges.

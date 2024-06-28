-- Set SQL mode to "NO_AUTO_VALUE_ON_ZERO" to prevent automatic increment of column values to zero.
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

-- Start a transaction to group a series of database operations together.
START TRANSACTION;

-- Set the time zone to UTC (+00:00) for consistent date and time handling.
SET time_zone = "+00:00";



/* ********************************************** */
        -- Table structure for table `users`
/* ********************************************** */
-- Create table `users`
CREATE TABLE `users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `gender` ENUM('male', 'female') NOT NULL DEFAULT 'male',
  `age` INT NOT NULL CHECK (age > 0),
  `email` VARCHAR(50)  UNIQUE,
  `phone` VARCHAR(20) UNIQUE,
  `options` VARCHAR(50),
  `password` VARCHAR(255) NOT NULL,
  `last_visit` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Set AUTO_INCREMENT for table `users` and start from 1
ALTER TABLE `users` AUTO_INCREMENT=001;

-- Define the phone format and length constraint
ALTER TABLE users
ADD CONSTRAINT `chk_phone_format_length`
CHECK ( phone IS NULL OR phone REGEXP '^\\+?(\\d{1,3})?[-. (]*(\\d{2,3})[-. )]*(\\d{3})[-. ]*(\\d{4})( *x(\\d+))?\\s*$'
    

);


-- Insert data into `users` table, ensuring phone number format and length constraints are met
INSERT INTO users (username, gender, age, email, phone, options, `password`)
VALUES ('admin', 'male', 21, 'admin@gmail.com', '+251 99-555-1234', 'admin', '$2y$10$YNUaplf0BMkC9gtXREqfSO5s9/Gz4bW4dJrj9POpo4Vwzd6zTzU5a');




/* ********************************************** */
-- Table structure for table `department_registration`

/* ********************************************** */
-- Create department_registration table
CREATE TABLE department_registration (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  gender ENUM('male', 'female') NOT NULL DEFAULT 'male',
  email VARCHAR(50)  UNIQUE,
  age INT NOT NULL CHECK (age > 0),
  phone VARCHAR(20) ,
  position VARCHAR(50) NOT NULL,
  last_visit TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add constraint for phone format
ALTER TABLE department_registration
ADD CONSTRAINT chk_phone_format_length_dr
CHECK (phone IS NULL OR phone REGEXP '^\\+?(\\d{1,3})?[-. (]*(\\d{2,3})[-. )]*(\\d{3})[-. ]*(\\d{4})( *x(\\d+))?\\s*$');

-- Set AUTO_INCREMENT for department_registration table
ALTER TABLE department_registration AUTO_INCREMENT=1;


/* ********************************************** */
-- Table structure for table `inventory`

/* ********************************************** */

CREATE TABLE inventory (
  `ordinary_number` INT PRIMARY KEY AUTO_INCREMENT,
  `department` VARCHAR(50) NOT NULL,
  `inventory_list` VARCHAR(50) NOT NULL,
  `item_type` VARCHAR(50) NOT NULL,
  `item_category` VARCHAR(20) NOT NULL, 
  `description` VARCHAR(255),
  `measure` VARCHAR(50),
  `quantity` INT NOT NULL CHECK (quantity >= 0),
  `price` INT NOT NULL CHECK (price >= 0),
  `total_price` INT AS (quantity * price) STORED,
  `examination` VARCHAR(255),
  `last_visit` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/* ********************************************** */
-- Table structure for table `departments`

/* ********************************************** */

CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) UNIQUE NOT NULL
);

INSERT INTO departments (`name`) VALUES   ('IT'), ('ART'), ('AUTO'), ('BUSINESS');

/* ********************************************** */
-- Table structure for table `bin`

/* ********************************************** */

CREATE TABLE bin (
  id INT PRIMARY KEY AUTO_INCREMENT,
  `date` DATE,
  income INT,
  cost INT,
  remain INT,
  short VARCHAR(50)
);

/* ********************************************** */
-- Table structure for table `model_20`

/* ********************************************** */

CREATE TABLE model_20 (
  `ordinary_number` INT PRIMARY KEY AUTO_INCREMENT,
  quantity INT,
  `item_type` VARCHAR(50),
  `item_category` VARCHAR(20) NOT NULL,
  model VARCHAR(50),
  `update` VARCHAR(50),
   requested_by VARCHAR(100),
  `status` ENUM('pending', 'approved', 'declined') DEFAULT 'pending',
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


/* ********************************************** */
-- Table structure for table `model_19`

/* ********************************************** */

CREATE TABLE model_19 (
  `ordinary_number` INT PRIMARY KEY AUTO_INCREMENT,
  `item_type` VARCHAR(50), 
  `item_category` VARCHAR(20) NOT NULL,
  added_by VARCHAR(100),
  model VARCHAR(50),
  serie INT,
  quantity INT NOT NULL CHECK (quantity >= 0),
  price INT NOT NULL CHECK (price >= 0),
  `total_price` INT AS (quantity * price) STORED,
  `status` ENUM('pending', 'approved', 'declined') DEFAULT 'pending',
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Commit the transaction to save changes.
COMMIT;
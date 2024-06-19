-- Set SQL mode to "NO_AUTO_VALUE_ON_ZERO" to prevent automatic increment of column values to zero.
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

-- Start a transaction to group a series of database operations together.
START TRANSACTION;

-- Set the time zone to UTC (+00:00) for consistent date and time handling.
SET time_zone = "+00:00";

-- Table structure for table `register`
CREATE TABLE register (
  id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  username VARCHAR(50),
  gender VARCHAR(10),
  age INT,
  email VARCHAR(50) UNIQUE NOT NULL,
  Phone VARCHAR(20) UNIQUE,
  options VARCHAR(50),
  passwords VARCHAR(255)
);


-- AUTO_INCREMENT for table `register`

ALTER TABLE `register` MODIFY `id` INT(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 100;


-- Table structure for table `user`
CREATE TABLE `user` (
  id INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(50),
  `email` VARCHAR(50) UNIQUE NOT NULL,
  `password` VARCHAR(255),
  `option` VARCHAR(50)
);



-- AUTO_INCREMENT for table `user`

ALTER TABLE `user` MODIFY `id` INT(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 100;


-- insert data into `user` table

INSERT INTO `user` (`user_name`, `email`, `password`, `option`)
VALUES ('admin', 'admin@gmail.com', '$2y$10$YNUaplf0BMkC9gtXREqfSO5s9/Gz4bW4dJrj9POpo4Vwzd6zTzU5a', 'admin');

-- Table structure for table `department_registration`
CREATE TABLE department_registration ( 
  id INT(10) PRIMARY KEY NOT NULL,
  username VARCHAR(50),
  email VARCHAR(50) UNIQUE,
  age INT,
  phone VARCHAR(20),
  position VARCHAR(50)
);

-- AUTO_INCREMENT for table `department_registration`
ALTER TABLE `department_registration` MODIFY `id` INT(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 100;


-- Table structure for table `inventory`
CREATE TABLE inventory (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `department` VARCHAR(50),
  `inventory-list` VARCHAR(50),
  `item-type` VARCHAR(50),
  `description` VARCHAR(50),
  measure INT,
  quantity INT,
  price INT,
  `total-price` INT,
  examination VARCHAR(50)
);


-- Table structure for table `departments`
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL
);

INSERT INTO departments (`name`) VALUES   ('IT'), ('ART'), ('AUTO'), ('BUSINESS');

-- Table structure for table `bin`
CREATE TABLE bin (
  id INT PRIMARY KEY AUTO_INCREMENT,
  `date` DATE,
  income INT,
  cost INT,
  remain INT,
  short INT
);

-- Table structure for table `model_20`
CREATE TABLE model_20 (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  quantity INT,
  `item-type` VARCHAR(50),
  model VARCHAR(50),
  `update` VARCHAR(50)
);

-- Table structure for table `model_19`
CREATE TABLE model_19 (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `item-type` VARCHAR(50),
  model VARCHAR(50),
  serie INT,
  quantity INT,
  price INT,
  `total-price` INT
);



-- Table structure for table `register`

CREATE TABLE register (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50),
  gender VARCHAR(10),
  age INT,
  email VARCHAR(50) UNIQUE NOT NULL,
  Phone VARCHAR(20) UNIQUE,
  options VARCHAR(50),
  passwords VARCHAR(255)
);

-- Table structure for table `user`

CREATE TABLE `user` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_name` VARCHAR(50),
  `email` VARCHAR(50) UNIQUE NOT NULL,
  `password` VARCHAR(255),
  `option` VARCHAR(50)
);

INSERT INTO `user` (`user_name`, `email`, `password`, `option`)
VALUES ('admin', 'admin@admin123', '$2y$10$YNUaplf0BMkC9gtXREqfSO5s9/Gz4bW4dJrj9POpo4Vwzd6zTzU5a', 'it head');


-- Table structure for table `art department`

CREATE TABLE art_department (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `inventory-list` VARCHAR(50),
  `description` VARCHAR(50),
  measure INT,
  quantity INT,
  price INT,
  `total-price` INT,
  examination VARCHAR(50)
);

-- Table structure for table `business department`

CREATE TABLE business_department (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `inventory-list` VARCHAR(50),
  `description` VARCHAR(50),
  measure INT,
  quantity INT,
  price INT,
  `total-price` INT,
  examination VARCHAR(50)
);


-- Table structure for table `auto department`

CREATE TABLE auto_department (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `inventory-list` VARCHAR(50),
  `description` VARCHAR(50),
  measure INT,
  quantity INT,
  price INT,
  `total-price` INT,
  examination VARCHAR(50)
);


-- Table structure for table `it department`

CREATE TABLE it_department (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `inventory-list` VARCHAR(50),
  `description` VARCHAR(50),
  measure INT,
  quantity INT,
  price INT,
  `total-price` INT,
  examination VARCHAR(50)
);

-- Table structure for table `purchase`

CREATE TABLE Purchase (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `inventory-list` VARCHAR(50),
  `description` VARCHAR(50),
  measure INT,
  quantity INT,
  price INT,
  `total-price` INT,
  examination VARCHAR(50)
);

-- Table structure for table `bin`

CREATE TABLE bin (
  id INT PRIMARY KEY AUTO_INCREMENT,
  `date` DATE,
  income INT,
  cost INT,
  remain INT,
  short INT
);

-- Table structure for table `department_registration`

CREATE TABLE department_registration (
  id INT PRIMARY KEY AUTO_INCREMENT,
 username VARCHAR(50),
email VARCHAR(50) UNIQUE,
age INT,
phone VARCHAR(20),
position VARCHAR(50)
);


-- Table structure for table `model 20`

CREATE TABLE model_20 (
 `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
quantity INT,
`item-type` VARCHAR(50),
model VARCHAR(50),
`update` VARCHAR(50)
);


-- Table structure for table `model 19`

CREATE TABLE model_19 (
`ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
`item-type` VARCHAR(50),
model VARCHAR(50),
serie INT,
quantity INT,
price INT,
`total-price` INT
);
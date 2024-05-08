

-- Table structure for table `register`

CREATE TABLE register (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255),
  gender VARCHAR(10),
  age INT,
  email VARCHAR(255),
  Phone VARCHAR(20),
  options VARCHAR(255),
  passwords VARCHAR(255)
);

-- Table structure for table `user`

CREATE TABLE `user` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_name` VARCHAR(255),
  `password` VARCHAR(255),
  `option` VARCHAR(255)
);


-- Table structure for table `art department`

CREATE TABLE art_department (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `inventory-list` VARCHAR(255),
  `description` VARCHAR(255),
  measure INT,
  quantity INT,
  price INT,
  `total-price` INT,
  examination VARCHAR(255)
);

-- Table structure for table `business department`

CREATE TABLE business_department (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `inventory-list` VARCHAR(255),
  `description` VARCHAR(255),
  measure INT,
  quantity INT,
  price INT,
  `total-price` INT,
  examination VARCHAR(255)
);


-- Table structure for table `auto department`

CREATE TABLE auto_department (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `inventory-list` VARCHAR(255),
  `description` VARCHAR(255),
  measure INT,
  quantity INT,
  price INT,
  `total-price` INT,
  examination VARCHAR(255)
);


-- Table structure for table `it department`

CREATE TABLE it_department (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `inventory-list` VARCHAR(255),
  `description` VARCHAR(255),
  measure INT,
  quantity INT,
  price INT,
  `total-price` INT,
  examination VARCHAR(255)
);

-- Table structure for table `purchase`

CREATE TABLE Purchase (
  `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
  `inventory-list` VARCHAR(255),
  `description` VARCHAR(255),
  measure INT,
  quantity INT,
  price INT,
  `total-price` INT,
  examination VARCHAR(255)
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
 username VARCHAR(255),
email VARCHAR(255),
age INT,
phone VARCHAR(20),
position VARCHAR(255)
);


-- Table structure for table `model 20`

CREATE TABLE model_20 (
 `ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
quantity INT,
`item-type` VARCHAR(255),
model VARCHAR(255),
`update` VARCHAR(255)
);


-- Table structure for table `model 19`

CREATE TABLE model_19 (
`ordinary-number` INT PRIMARY KEY AUTO_INCREMENT,
`item-type` VARCHAR(255),
model VARCHAR(255),
serie INT,
quantity INT,
price INT,
`total-price` INT
);
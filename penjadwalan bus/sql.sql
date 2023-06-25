-- Create bus_list table
CREATE TABLE bus_list (
  bus_id INT AUTO_INCREMENT PRIMARY KEY,
  bus_company VARCHAR(255) NOT NULL,
  bus_code VARCHAR(255) NOT NULL,
  UNIQUE (bus_company),
  INDEX (bus_code)
);

-- Create bus_schedule table
CREATE TABLE bus_schedule (
  schedule_id INT AUTO_INCREMENT PRIMARY KEY,
  bus_company VARCHAR(255) NOT NULL,
  bus_code VARCHAR(255) NOT NULL,
  from_location VARCHAR(255) NOT NULL,
  to_location VARCHAR(255) NOT NULL,
  from_time DATETIME NOT NULL,
  to_time DATETIME NOT NULL,
  seats INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (bus_company) REFERENCES bus_list(bus_company),
  FOREIGN KEY (bus_code) REFERENCES bus_list(bus_code)
) ENGINE=InnoDB;

-- Create users table
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  saldo DECIMAL(10, 2) NOT NULL
);

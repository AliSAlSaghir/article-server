<?php

require('../connection/connection.php');

$query = 'CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )';

if ($mysqli->query($query)) {
  echo 'Table `users` created successfully.';
} else {
  echo 'Error creating table' . $mysqli->error;
}

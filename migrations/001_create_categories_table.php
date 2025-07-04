<?php
require("../connection/connection.php");


$query = "CREATE TABLE categories(
          id INT(11) AUTO_INCREMENT PRIMARY KEY,
          name VARCHAR(50) NOT NULL UNIQUE )";

if ($mysqli->query($query)) {
  echo "Table `categories` created successfully.";
} else {
  echo "Error creating table: " . $mysqli->error;
}

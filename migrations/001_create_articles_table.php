<?php
require("../connection/connection.php");

$query = "CREATE TABLE articles(
          id INT AUTO_INCREMENT PRIMARY KEY,
          title VARCHAR(100) NOT NULL,
          author INT NOT NULL,
          description TEXT NOT NULL,
          
          FOREIGN KEY (author) REFERENCES users(id) ON DELETE CASCADE
          )";

if ($mysqli->query($query)) {
  echo "Table `articles` created successfully.";
} else {
  echo "Error creating table: " . $mysqli->error;
}

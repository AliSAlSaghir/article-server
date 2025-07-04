<?php
require("../connection/connection.php");

$query = "CREATE TABLE articles(
          id INT AUTO_INCREMENT PRIMARY KEY,
          title VARCHAR(100) NOT NULL,
          author_id INT NOT NULL,
          category_id INT NOT NULL,
          description TEXT NOT NULL,
          
          FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE,
          FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
          )";

if ($mysqli->query($query)) {
  echo "Table `articles` created successfully.";
} else {
  echo "Error creating table: " . $mysqli->error;
}

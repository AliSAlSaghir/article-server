<?php

require('../connection/connection.php');

$query = 'CREATE TABLE article_categories(
    article_id INT,
    category_id INT,
    PRIMARY KEY (category_id, article_id),
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE
)';

if ($mysqli->query($query)) {
  echo "table `article_categories` created successfully";
} else {
  echo "error creating table" . $mysqli->error;
}

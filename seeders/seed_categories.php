<?php
require_once '../connection/connection.php';
require_once '../models/Category.php';

Model::setDB($mysqli);

$categories = [
  'Technology',
  'Health',
  'Education',
  'Travel',
  'Food'
];

foreach ($categories as $name) {
  Category::create([
    'name' => $name
  ]);
}

echo "Categories seeded successfully.";

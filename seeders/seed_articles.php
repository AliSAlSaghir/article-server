<?php
require_once '../connection/connection.php';
require_once '../models/Article.php';

Model::setDB($mysqli);

$articles = [
  [
    'title' => 'The Future of Tech',
    'description' => 'A look into what’s coming in technology.',
    'author_id' => 1,
    'category_id' => 1,
  ],
  [
    'title' => 'Staying Fit at Home',
    'description' => 'Tips and routines to stay healthy indoors.',
    'author_id' => 2,
    'category_id' => 2,
  ],
  [
    'title' => 'Travel on a Budget',
    'description' => 'Explore the world without breaking the bank.',
    'author_id' => 1,
    'category_id' => 4,
  ],
  [
    'title' => 'The Education Revolution',
    'description' => 'How digital tools are changing learning.',
    'author_id' => 2,
    'category_id' => 3,
  ],
  [
    'title' => 'Delicious Meals in 30 Minutes',
    'description' => 'Quick and tasty meals anyone can cook.',
    'author_id' => 1,
    'category_id' => 5,
  ],
];

foreach ($articles as $article) {
  Article::create($article);
}

echo "Articles seeded successfully.";

<?php

$apis = [
  '/get_articles'         => ['controller' => 'ArticleController', 'method' => 'getArticles'],
  '/create_article'         => ['controller' => 'ArticleController', 'method' => 'createArticle'],
  '/update_article'         => ['controller' => 'ArticleController', 'method' => 'updateArticle'],
  '/delete_articles'         => ['controller' => 'ArticleController', 'method' => 'deleteArticles'],

  '/get_categories'         => ['controller' => 'CategoryController', 'method' => 'getCategories'],
  '/create_category'         => ['controller' => 'CategoryController', 'method' => 'createCategory'],
  '/update_category'         => ['controller' => 'CategoryController', 'method' => 'updateCategory'],
  '/delete_categories'         => ['controller' => 'CategoryController', 'method' => 'deleteCategories'],
];

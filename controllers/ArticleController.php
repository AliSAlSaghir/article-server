<?php

require __DIR__ . '/BaseController.php';
require __DIR__ . "/../models/Article.php";
require __DIR__ . "/../services/ArticleService.php";

class ArticleController extends BaseController {

  public function getArticles() {
    if (isset($_GET["category_id"])) {
      $categoryId = (int)$_GET["category_id"];
      $articles = array_map(fn($a) => $a->toArray(), Article::where('category_id', $categoryId));
      ResponseService::response(200, $articles);
      return;
    }

    if (isset($_GET["article_id"])) {
      $articleId = (int)$_GET["article_id"];
      $article = Article::find($articleId);

      if (!$article) {
        ResponseService::response(404, ['error' => 'Article not found']);
        return;
      }

      ResponseService::response(200, $article->toArray());
      return;
    }

    $articles = array_map(fn($a) => $a->toArray(), Article::all());
    ResponseService::response(200, $articles);
  }

  public function createArticle() {
    $input = ValidationService::validateInput();

    $author_id = $input['author_id'] ?? null;
    $category_id = $input['category_id'] ?? null;
    $title = $input['title'] ?? null;
    $description = $input['description'] ?? null;

    if (!$author_id || !$category_id || !$title || !$description) {
      ResponseService::response(400, ['error' => 'Missing fields!']);
    }

    $article = Article::create([
      'author_id' => $author_id,
      'category_id' => $category_id,
      'title' => $title,
      'description' => $description
    ]);

    if ($article) {
      ResponseService::response(201, $article->toArray());
    } else {
      ResponseService::response(500, ['error' => 'Failed to create article']);
    }
  }

  public function updateArticle() {
    $input = ValidationService::validateInput();

    $id = $input['id'] ?? null;
    if (!$id || !is_numeric($id)) {
      ResponseService::response(400, ['error' => 'Missing or  invalid article ID']);
    }

    $article = Article::find((int)$id);
    if (!$article) {
      ResponseService::response(404, ['error' => 'Article not found']);
    }

    if (isset($input['category_id'])) $article->setCategoryId($input['category_id']);
    if (isset($input['title'])) $article->setTitle($input['title']);
    if (isset($input['description'])) $article->setDescription($input['description']);

    if ($article->update()) {
      ResponseService::response(200, ['message' => 'Article updated successfully']);
    } else {
      ResponseService::response(500, ['error' => 'Failed to update article']);
    }
  }

  public function deleteArticles() {
    $input = ValidationService::validateInput();

    $id = $input['id'] ?? null;

    if ($id !== null) {
      if (!is_numeric($id)) {
        ResponseService::response(400, ['error' => 'Invalid article ID']);
        return;
      }

      $article = Article::find((int)$id);
      if (!$article) {
        ResponseService::response(404, ['error' => 'Article not found']);
        return;
      }

      if (Article::delete((int)$id)) {
        ResponseService::response(200, ['message' => 'Article deleted successfully']);
      } else {
        ResponseService::response(500, ['error' => 'Failed to delete article']);
      }

      return;
    }

    if (Article::deleteAll()) {
      ResponseService::response(200, ['message' => 'All articles deleted successfully']);
    } else {
      ResponseService::response(500, ['error' => 'Failed to delete all articles']);
    }
  }
}

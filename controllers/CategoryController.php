<?php

require __DIR__ . '/BaseController.php';
require __DIR__ . "/../models/Category.php";

class CategoryController extends BaseController {

  public function getCategories() {
    if (!isset($_GET["id"])) {
      $categories = array_map(fn($category) => $category->toArray(), Category::all());
      ResponseService::response(200, $categories);
      return;
    }

    $id = isset($_GET['id']) ? (int)($_GET['id']) : null;
    $category = Category::find($id);

    if (!$category) {
      ResponseService::response(404, ['error' => 'Category not found']);
      return;
    }
    ResponseService::response(200, $category->toArray());
  }

  public function createCategory() {
    $input = ValidationService::validateInput();

    $name = $input['name'] ?? null;

    if (!$name) {
      ResponseService::response(400, ['error' => 'Category name is required']);
    }

    $category = Category::create([
      'name' => $name,
    ]);

    if ($category) {
      ResponseService::response(201, $category->toArray());
    } else {
      ResponseService::response(500, ['error' => 'Failed to create category']);
    }
  }

  public function updateCategory() {
    $input = ValidationService::validateInput();

    $id = $input['id'] ?? null;
    if (!$id || !is_numeric($id)) {
      ResponseService::response(400, ['error' => 'Missing or  invalid category ID']);
    }

    $category = Category::find((int)$id);
    if (!$category) {
      ResponseService::response(404, ['error' => 'Category not found']);
    }

    if (isset($input['name'])) $category->setName($input['name']);

    if ($category->update()) {
      ResponseService::response(200, ['message' => 'Category updated successfully']);
    } else {
      ResponseService::response(500, ['error' => 'Failed to update category']);
    }
  }

  public function deleteCategories() {
    $input = ValidationService::validateInput();

    $id = $input['id'] ?? null;

    if ($id !== null) {
      if (!is_numeric($id)) {
        ResponseService::response(400, ['error' => 'Invalid category ID']);
        return;
      }

      $category = Category::find((int)$id);
      if (!$category) {
        ResponseService::response(404, ['error' => 'Category not found']);
        return;
      }

      if (Category::delete((int)$id)) {
        ResponseService::response(200, ['message' => 'Category deleted successfully']);
      } else {
        ResponseService::response(500, ['error' => 'Failed to delete category']);
      }

      return;
    }

    if (Category::deleteAll()) {
      ResponseService::response(200, ['message' => 'All categories deleted successfully']);
    } else {
      ResponseService::response(500, ['error' => 'Failed to delete all categories']);
    }
  }
}

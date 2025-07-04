<?php
require_once("Model.php");

class Article extends Model {
  protected static string $table = "articles";

  private ?int $id;
  private string $title;
  private int $author_id;
  private int $category_id;
  private string $description;


  public function __construct(array $data) {
    foreach ($data as $key => $value) {
      if (property_exists($this, $key)) {
        $this->$key = $value;
      }
    }
  }

  private function loadAuthor() {
    $author = User::find($this->author_id);
    return $author ? $author->toArray() : null;
  }

  private function loadCategory() {
    $category = Category::find($this->category_id);
    return $category ? $category->toArray() : null;
  }


  public function toArray(): array {
    $data = get_object_vars($this);

    $data['author'] = $this->loadAuthor();
    $data['category'] = $this->loadCategory();

    return $data;
  }
}

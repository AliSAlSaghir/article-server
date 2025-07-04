<?php
require_once("Model.php");

class Category extends Model {
  protected static string $table = "categories";

  private ?int $id;
  private string $name;


  public function __construct(array $data) {
    foreach ($data as $key => $value) {
      if (property_exists($this, $key)) {
        $this->$key = $value;
      }
    }
  }

  public function toArray() {
    return get_object_vars($this);
  }
}

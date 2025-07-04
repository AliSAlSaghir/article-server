<?php
require_once("Model.php");

class User extends Model {
  protected static string $table = 'users';

  private ?int $id;
  private string $name;
  private string $email;
  private string $password;
  private ?string $created_at;

  public function __construct(array $data) {
    foreach ($data as $key => $value) {
      if (property_exists($this, $key)) {
        $this->$key = $value;
      }
    }
  }

  public function toArray() {
    $data = get_object_vars($this);
    unset($data['password']);
    return $data;
  }
}

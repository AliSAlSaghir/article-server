<?php
abstract class Model {
  protected static string $table;
  protected static string $primary_key = "id";
  protected static mysqli $db;

  public static function setDB(mysqli $db): void {
    static::$db = $db;
  }

  public static function find(int $id) {
    $sql = sprintf("SELECT * FROM %s WHERE %s = ?", static::$table, static::$primary_key);

    $stmt = static::$db->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $data = $stmt->get_result()->fetch_assoc();
    return $data ? new static($data) : null;
  }

  public static function all(): array {
    $sql = sprintf("SELECT * FROM %s", static::$table);
    $stmt = static::$db->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $objects = [];

    while ($row = $result->fetch_assoc()) {
      $objects[] = new static($row);
    }

    return $objects;
  }

  public static function create(array $data) {
    $columns = array_keys($data);
    $placeholders = implode(',', array_fill(0, count($columns), '?'));
    $types = static::getParamTypes(array_values($data));

    $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", static::$table, implode(',', $columns), $placeholders);
    $stmt = static::$db->prepare($sql);
    $stmt->bind_param($types, ...array_values($data));
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      $id = $stmt->insert_id;
      return static::find($id);
    }

    return null;
  }

  public function update(): bool {
    $data = get_object_vars($this);
    $primaryKey = static::$primary_key;
    $id = $data[$primaryKey];
    unset($data[$primaryKey]);

    $columns = array_keys($data);
    $placeholders = implode(', ', array_map(fn($col) => "$col = ?", $columns));
    $types = static::getParamTypes(array_values($data));

    $sql = sprintf("UPDATE %s SET %s WHERE %s = ?", static::$table, $placeholders, $primaryKey);
    $stmt = static::$db->prepare($sql);

    $types .= 'i';
    $params = array_merge(array_values($data), [$id]);
    $stmt->bind_param($types, ...$params);


    return $stmt->execute();
  }

  public static function delete(int $id): bool {
    $sql = sprintf("DELETE FROM %s WHERE %s = ?", static::$table, static::$primary_key);
    $stmt = static::$db->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
  }

  protected static function getParamTypes(array $params): string {
    return implode('', array_map(function ($param) {
      return match (gettype($param)) {
        'integer' => 'i',
        'double'  => 'd',
        'string'  => 's',
        default   => 's'
      };
    }, $params));
  }
}

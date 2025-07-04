<?php

require_once __DIR__ . '/ResponseService.php';


class ValidationService {
  public static function validateInput() {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input) {
      ResponseService::response(400, ['error' => 'Invalid JSON input']);
    }

    return $input;
  }
}

<?php

class ResponseService {
  public static function response($code, $data) {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode(['status' => $code] + $data);
    exit;
  }
}

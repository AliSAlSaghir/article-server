<?php

require_once __DIR__ . '/../connection/connection.php';
require_once __DIR__ . '/../models/Model.php';
require_once __DIR__ . '/../services/ResponseService.php';
require_once __DIR__ . '/../services/ValidationService.php';

abstract class BaseController {
  public function __construct() {
    global $mysqli;
    Model::setDB($mysqli);
  }
}

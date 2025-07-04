<?php
require_once '../connection/connection.php';
require_once '../models/User.php';

Model::setDB($mysqli);

$user1 = [
  'name' => 'Ali Saghir',
  'email' => 'ali@example.com',
  'password' => password_hash("secret123", PASSWORD_DEFAULT),
  'created_at' => date('Y-m-d H:i:s')
];

$user2 = [
  'name' => 'Gheeda',
  'email' => 'gheeda@example.com',
  'password' => password_hash("gheeda", PASSWORD_DEFAULT),
  'created_at' => date('Y-m-d H:i:s')
];

User::create($user1);
User::create($user2);

echo "Users seeded successfully.";

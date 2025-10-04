<?php
$DB_HOST = "localhost"; // adapter
$DB_NAME = "base_etdv";
$DB_USER = "root"; // adapter
$DB_PASS = "monpass2001";     // adapter

try {
  $pdo = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4", $DB_USER, $DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(["error" => "Erreur connexion DB"]);
  exit;
}
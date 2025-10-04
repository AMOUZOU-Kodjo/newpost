<?php
session_start();
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/config.php';

function requireLogin() {
  if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
  }
}
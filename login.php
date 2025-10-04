<?php
require_once __DIR__ . '/auth.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = ? LIMIT 1');
  $stmt->execute([$username]);
  $admin = $stmt->fetch();

  if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['admin'] = $admin['username'];
    header('Location: admin.php');
    exit;
  } else {
    $error = 'Identifiants incorrects';
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - <?= htmlspecialchars($appName) ?></title>
  <link rel="stylesheet" href="admin.css">
</head>
<body class="auth">
  <form class="card" method="post">
    <h2>Connexion Admin</h2>
    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <label>Utilisateur
      <input type="text" name="username" required>
    </label>
    <label>Mot de passe
      <input type="password" name="password" required>
    </label>
    <button type="submit" class="btn">Se connecter</button>
  </form>
</body>
</html>
<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "monpass2001";
$dbname = "base_etdv";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$stmt = $conn->prepare("SELECT * FROM contenus WHERE type_contenu = 'message' ORDER BY date_publication DESC");
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages Bibliques-Evenements</title>
    <style>
        body {font-family: 'poppins',sans-serif; padding: 2rem; }
        .h1{text-align: center; font-size: 3rem; margin: 3rem 0; text-decoration: underline; text-transform: uppercase;}
        .message-box {width: 100% ; height: auto; border: 1px solid #ccc; padding: 1.5rem; margin-bottom: 1.5rem; border-radius: 8px; }
        .message-box:hover{ background: #beff; border: none; transition: 0.5s ease-in-out}
        .message{display: grid; gap: 3rem; grid-template-columns: repeat(3, 1fr);}
        @media screen and (max-width: 768px){
            .message{
                grid-template-columns: repeat(1, 1fr);
                gap: 2rem;
            }
            .h1{font-size: 1.5rem}
        }
    </style>
</head>
<body>
    <h1 class="h1">Messages Bibliques-Evenements</h1>
    <?php if (count($messages) > 0): ?>
        <div class="message">
            <?php foreach ($messages as $msg): ?>
               
                    <div class="message-box">
                    <h2><?php echo htmlspecialchars($msg['titre']); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($msg['description'])); ?></p>
                    <small>Publié le <?php echo date("d/m/Y", strtotime($msg['date_publication'])); ?></small>
                    </div>
              
            <?php endforeach; ?>
         </div>
    <?php else: ?>
        <p>Aucun message n'est disponible pour le moment.</p>
    <?php endif; ?>
</body>
</html>
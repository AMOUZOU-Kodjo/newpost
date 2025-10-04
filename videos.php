<?php
// Connexion à la base de données... (même code)
$servername = "localhost";
$username = "root";
$password = "monpass2001";
$dbname = "base_etdv";
// ... (suite du code de connexion)
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$stmt = $conn->prepare("SELECT * FROM contenus WHERE type_contenu = 'video' ORDER BY date_publication DESC");
$stmt->execute();
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vidéos</title>
    <style>
        body { font-family: 'poppins', sans-serif; padding: 2rem; }
        .video-list { display: flex; grid-template-columns: repeat(4, 1fr); gap: 3rem; }
        .video-item{display: flex; flex-direction: column; justify-content: center; align-items: center; width:20rem; height: 15rem; border: 1px solid #ccc; border-radius: 8px; overflow: hidden; text-align: center;}
        .video-item:hover{box-shadow: 0 0 20px var(--button-color); transform: scale(1.1);}
        .video-item video { max-width: 100%; height: auto; display: block; }
        @media screen and (max-width: 768px){
            .video-list{
        display: grid; 
        /*flex-direction: column;*/
        grid-template-columns: repeat(1, 1fr); 
        gap: 2rem;
            }
            .video-item{
                height: auto;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1 class="h1">Vidéos</h1>
    <?php if (count($videos) > 0): ?>
        <div class="video-list">
            <?php foreach ($videos as $vid): ?>
                <div class="video-item">
                    
                    <video controls>
                        <source src="<?php echo htmlspecialchars($vid['url_ressource']); ?>" type="video/mp4">
                        Votre navigateur ne supporte pas la balise vidéo.
                    </video>
                    <!-- <h2><?php echo htmlspecialchars($vid['titre']); ?></h2>
                    <p><small><?php echo htmlspecialchars($vid['description']); ?></small></p> -->
                </div>
            <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune vidéo n'est disponible pour le moment.</p>
    <?php endif; ?>
</body>
</html>
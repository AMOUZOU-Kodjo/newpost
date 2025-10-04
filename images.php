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

$stmt = $conn->prepare("SELECT * FROM contenus WHERE type_contenu = 'image' ORDER BY date_publication DESC");
$stmt->execute();
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Galerie d'images</title>
    <style>
        body { font-family: 'poppins', sans-serif; padding: 2rem; }
        .gallery { display: grid; grid-template-columns: repeat(4, 1fr); gap: 3rem; }
        .image-card { width: 26rem; height: 22rem; border: 1px solid #ccc; border-radius: 8px; overflow: hidden; text-align: center; display: flex; flex-direction: column; }
        .image-card:hover{box-shadow: 0 0 20px var(--button-color);}
         .h1{text-align: center; font-size: 3rem; margin-bottom: 3rem; text-decoration: underline; text-transform: uppercase;}
        .image-card img { width: 100%; height: 15rem; display: block; }
        .image-card h3 { margin: 0.5rem 0; font-size: 1.1rem; display: none;}
        .image-card a{
            position : relative;
            padding: 0.5rem 1rem;
            margin-top: 2rem;
            font-weight: 600;
            background: #dcdcdc;
            border-radius: 1rem;
        }
        .image-card:hover h3{display: flex ; position: absolute; bottom: 5rem; left: 5rem; }
        @media screen and (max-width: 768px){
            .gallery{
        display: grid; 
        /*flex-direction: column;*/
        grid-template-columns: repeat(1, 1fr); 
        gap: 2rem;
            }
            .image-card{
                height: auto;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1 class="h1">Galerie d'images</h1>
    <?php if (count($images) > 0): ?>
        <div class="gallery">
            <?php foreach ($images as $img): ?>
                <div class="image-card">
                    <img controls src="<?php echo htmlspecialchars($img['url_ressource']); ?>" alt="<?php echo htmlspecialchars($img['titre']); ?>  ">
                    <a href="<?php echo htmlspecialchars($img['url_ressource']); ?>">Download</a>
                    <!-- <div class="image-items">
                        <h3><?php echo htmlspecialchars($img['titre']); ?></h3>
                    <p><small><?php echo htmlspecialchars($img['description']); ?></small></p>
                    </div> -->
                </div>
                

            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucune image n'est disponible pour le moment.</p>
    <?php endif; ?>
</body>
</html>
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

// Gérer l'ajout d'un nouveau contenu
if (isset($_POST['ajouter_contenu'])) {
    $type = $_POST['type_contenu'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $url_ressource = '';

    if ($type == 'message') {
        $url_ressource = $description;
    } else {
        if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] == 0) {
            $upload_dir = 'uploads/';
            $nom_fichier = basename($_FILES['fichier']['name']);
            $chemin_final = $upload_dir . uniqid() . '-' . $nom_fichier;

            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $chemin_final)) {
                $url_ressource = $chemin_final;
            } else {
                echo "<p style='color:red;'>Erreur lors du téléchargement du fichier.</p>";
            }
        }
    }
    
    if ($url_ressource) {
        $stmt = $conn->prepare("INSERT INTO contenus (type_contenu, titre, description, url_ressource) VALUES (?, ?, ?, ?)");
        $stmt->execute([$type, $titre, $description, $url_ressource]);
        header("Location: admin.php");
        exit();
    }
}

// Gérer la suppression d'un contenu
if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT url_ressource FROM contenus WHERE id = ?");
    $stmt->execute([$id]);
    $contenu_a_supprimer = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($contenu_a_supprimer && strpos($contenu_a_supprimer['url_ressource'], 'uploads/') === 0) {
        unlink($contenu_a_supprimer['url_ressource']);
    }

    $stmt = $conn->prepare("DELETE FROM contenus WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php");
    exit();
}

// Gérer la modification d'un contenu
$contenu_a_modifier = null;
if (isset($_GET['action']) && $_GET['action'] == 'modifier' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM contenus WHERE id = ?");
    $stmt->execute([$id]);
    $contenu_a_modifier = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Enregistrer les modifications
if (isset($_POST['modifier_contenu'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $url_ressource = $_POST['url_actuelle'];

    if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] == 0) {
        $upload_dir = 'uploads/';
        $nom_fichier = basename($_FILES['fichier']['name']);
        $chemin_final = $upload_dir . uniqid() . '-' . $nom_fichier;
        
        // Supprimer l'ancien fichier s'il existe
        if (strpos($url_ressource, 'uploads/') === 0 && file_exists($url_ressource)) {
            unlink($url_ressource);
        }

        if (move_uploaded_file($_FILES['fichier']['tmp_name'], $chemin_final)) {
            $url_ressource = $chemin_final;
        } else {
            echo "<p style='color:red;'>Erreur lors du téléchargement du nouveau fichier.</p>";
        }
    }
    
    // Pour un message, on met à jour le texte dans la colonne url_ressource
    if ($_POST['type_contenu'] == 'message') {
        $url_ressource = $description;
    }

    $stmt = $conn->prepare("UPDATE contenus SET titre = ?, description = ?, url_ressource = ? WHERE id = ?");
    $stmt->execute([$titre, $description, $url_ressource, $id]);
    header("Location: admin.php");
    exit();
}

// Récupérer tous les contenus pour l'affichage
$stmt = $conn->query("SELECT * FROM contenus ORDER BY date_publication DESC");
$tous_les_contenus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration du site</title>
    <style>
        body { font-family: 'poppins', sans-serif; padding: 2rem; line-height: 1.6; background-color: #f4f7f9; color: #333; padding: 7rem 8% 7rem}
        .container { max-width: 900px; margin: 4rem auto; background-color: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        h1, h2 { color: #2c3e50; padding-bottom: 0.5rem; font-weight: 600; text-align: center}
        h2 { border-bottom: 2px solid #ecf0f1;}
        form { display: flex; flex-direction: column; gap: 3rem; }
        label { font-weight: bold; margin-top: 0.5rem; color: #555; }
        input[type="text"], input[type="file"], textarea, select { padding: 0.75rem; border: 1px solid #ccc; border-radius: 5px; font-size: 2rem; resize: none}
        input[type="file"]{border: none; background: #fdef;}
        button { padding: 0.75rem 1.5rem; background-color: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 1rem; transition: background-color 0.3s ease; }
        button:hover { background-color: #2980b9; }
        .contenu-list { margin-top: 2rem; display: flex; flex-direction: column; gap: 1rem; }
        .contenu-item { border: 1px solid #e0e0e0; padding: 1rem; border-radius: 8px; background-color: #fafafa; display: flex; justify-content: space-between; align-items: center; }
        .contenu-details { flex-grow: 1; }
        .contenu-actions a { color: #3498db; text-decoration: none; margin-left: 1rem; }
        .contenu-actions a.delete { color: #e74c3c; }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <header>
        <a href="admin.php" class="logo">E<span>TDV</span></a>
        <nav>
            <a href="admin.php" class="active">Panneau Admin</a>
            <a href="contenus.php">Contenus</a>
            <a href="logout.php">Déconnexion</a>

        </nav>
        <button class="menu">☰</button>
    </header>
    <div class="container">
        <h1>Panneau d'administration</h1>
        
        <h2><?php echo $contenu_a_modifier ? 'Modifier un contenu' : 'Ajouter un nouveau contenu'; ?></h2>
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <?php if ($contenu_a_modifier): ?>
                <input type="hidden" name="id" value="<?php echo $contenu_a_modifier['id']; ?>">
                <input type="hidden" name="modifier_contenu" value="1">
                <input type="hidden" name="url_actuelle" value="<?php echo htmlspecialchars($contenu_a_modifier['url_ressource']); ?>">
            <?php else: ?>
                <input type="hidden" name="ajouter_contenu" value="1">
            <?php endif; ?>

            <label for="type_contenu">Type de contenu :</label>
            <select id="type_contenu" name="type_contenu" <?php echo $contenu_a_modifier ? 'disabled' : ''; ?>>
                <option value="message" <?php echo $contenu_a_modifier && $contenu_a_modifier['type_contenu'] == 'message' ? 'selected' : ''; ?>>Message Biblique</option>
                <option value="image" <?php echo $contenu_a_modifier && $contenu_a_modifier['type_contenu'] == 'image' ? 'selected' : ''; ?>>Image</option>
                <option value="video" <?php echo $contenu_a_modifier && $contenu_a_modifier['type_contenu'] == 'video' ? 'selected' : ''; ?>>Vidéo</option>
            </select>
            
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" value="<?php echo $contenu_a_modifier ? htmlspecialchars($contenu_a_modifier['titre']) : ''; ?>" required>
            
            <label for="description">Description (ou contenu du message) :</label>
            <textarea id="description" name="description" rows="4"><?php echo $contenu_a_modifier ? htmlspecialchars($contenu_a_modifier['description']) : ''; ?></textarea>
            
            <label for="fichier">Télécharger un fichier (uniquement pour les images et vidéos) :</label>
            <input type="file" id="fichier" name="fichier">
            
            <button type="submit"><?php echo $contenu_a_modifier ? 'Enregistrer les modifications' : 'Ajouter le contenu'; ?></button>
        </form>

        
    </div>
</body>
</html>

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
    <link rel="stylesheet" href="style.css">

 <header>
        <a href="contenus.php" class="logo">E<span>TDV</span></a>
        <nav>
            <a href="admin.php">Panneau Admin</a>
            <a href="contenus.php" class="active">Contenus</a>
            <a href="logout.php">Déconnexion</a>

        </nav>
        <button class="menu">☰</button>
    </header>
<style>
    body { font-family: 'poppins', sans-serif; padding: 2rem; line-height: 1.6; background-color: #f4f7f9; color: #333; padding: 7rem 8% 7rem}
    h2{font-size: 2rem; margin: 3rem 0 ; text-align: center}
     .contenu-list { margin-top: 2rem; display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        .contenu-item { border: 1px solid #e0e0e0; padding: 1rem; border-radius: 8px; background-color: #fafafa; display: flex; justify-content: space-between; align-items: center; }
        .contenu-details { flex-grow: 1; }
        .contenu-actions a { color: #fff; text-decoration: none; margin-left: 1rem;  padding: 0 .5rem; background: #3498db; border-radius: 2px; font-weight: 600}
        .contenu-actions a.delete { color: red; background:#beff; }

         @media screen and (max-width: 800px){
            .contenu-list{
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</style>

<h2>Contenus existants</h2>
        <div class="contenu-list">
            <?php if (count($tous_les_contenus) > 0): ?>
                <?php foreach ($tous_les_contenus as $item): ?>
                    <div class="contenu-item">
                        <div class="contenu-details">
                            <strong>Type :</strong> <?php echo htmlspecialchars($item['type_contenu']); ?><br>
                            <strong>Titre :</strong> <?php echo htmlspecialchars($item['titre']); ?><br>
                            <small>Publié le <?php echo date("d/m/Y à H:i", strtotime($item['date_publication'])); ?></small>
                        </div>
                        <div class="contenu-actions">
                            <a href="?action=modifier&id=<?php echo $item['id']; ?>">Modifier</a>
                            <a href="?action=supprimer&id=<?php echo $item['id']; ?>" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?');">Supprimer</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun contenu n'est encore disponible.</p>
            <?php endif; ?>

     </div>

    <!-- <?php require 'footer.php' ?> -->
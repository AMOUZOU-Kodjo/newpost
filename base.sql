CREATE TABLE contenus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_contenu VARCHAR(20) NOT NULL, -- 'message', 'image' ou 'video'
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    url_ressource VARCHAR(255), -- Le chemin du fichier ou le texte du message
    date_publication DATETIME DEFAULT CURRENT_TIMESTAMP
);
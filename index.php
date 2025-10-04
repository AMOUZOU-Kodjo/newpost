<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Eglise</title>
</head>
<body>
    <style>footer .navigation a{
    margin: 0 2rem;
    color: var(--text-color);
    font-size: 1.3rem;
    font-weight: 600;
    border-bottom: 2px solid transparent;

}</style>
   <?php require 'header.php'  ?> 

    <section class="home active">
        <h1>ETDV : <span>E</span>glise <span>T</span>emple du <span>D</span>ieu <span>V</span>ivant </h1>

        <div class="ligne"></div>
        <div class="container">
            <div class="trait un"></div>
            <div class="trait deux"></div>
            <div class="trait trois"></div>
        </div>
       <div class="background-animation"></div>

        <div class="home-item">
            <div class="paragraphe">
                <p>Nous sommes heureux de vous accueillir sur le site officiel de notre communaiuté chrétienne. Ici, chaque âme est
                    précieuse, chaque coeur est une promesse, et chaque visite est une bénédiction. </p>
                <p>Notre mission est simple : aimer Dieu, servir notre prochain et faire grandir la foi en Jésus-Christ. Que vous soyez
                    en quête de vérité, curieux de découvrir notre foi, ou déjà enraciné dans l'amour du seigneur, vous êtes chez vous.
                </p>
                <p>Explorez nos enseignements, nos programmes spirituels, nos temps de prière et de louange, et rejoingnez une famille
                    où la présence de Dieu transforme les vies.
                </p>
                <p >"Venez à moi, vous tous qui êtes fatigués et chargés, et vous donnerai du repos." Mathieu 11 : 28</p>

                <div class="home-detail">
                    <h4>Un lieu où Dieu nous :
                        <span style="--i:5;" data-text=" Exauce"> Exauce</span>
                        <span style="--i:4;" data-text=" Enseigne">Enseigne</span>
                        <span style="--i:3;" data-text=" Guérie">Guérie</span>
                        <span style="--i:2;" data-text=" Délivre">Délivre</span>
                        <span style="--i:1;" data-text=" Transforme">Transforme</span>
                
                    </h4>
                </div>
                <div class="icon">
                    <a href=""><i class='bx bxl-facebook'></i><span>Facebook</span></a>
                    <a href=""><i class='bx bxl-whatsapp'></i><span>Whatsapp</span></a>
                    <a href=""><i class='bx bxl-twitter'></i> <span>Twitter</span></a>
                    <!-- <a href=""><i class='bx bxl-instagram'></i> <span>Instagram</span></a> -->
                    <!-- <a href=""><i class='bx bxl-tiktok'></i><span>Tiktok</span></a> -->
                    <!-- <a href=""><i class='bx bxl-linkedin'></i><span>Linkedin</span></a> -->
                    <!-- <a href=""><i class='bx bxl-github'></i></a> -->
                </div> 
                <div class=""><a href="about.php"><button>En savoir plus</button></a></div>
            </div>
            <div class="home-img">
                <div class="img-box">
                    <div class="img-item">
                        <img src="LOGO.png">
                    </div>
                </div>
            </div>
        </div>
        
        
    </section>

    <footer>
        <div class="pied">
            <p>&copy Copyright <span>Marcellin</span> | Tous droits reservés</p>
        </div>
        
        <div class="icon">
                    <a href=""><i class='bx bxl-facebook'></i><span>Facebook</span></a>
                    <a href=""><i class='bx bxl-whatsapp'></i><span>Whatsapp</span></a>
                    <a href=""><i class='bx bxl-twitter'></i> <span>Twitter</span></a>
        </div> 
        <div class="navigation">
            <a href="about.php">About me</a>
            <a href="events.php">Programs</a>
            <a href="contacts.php">Contact</a>
        </div>
        <div class="pied">
            <p>Développé par <span>Marcellin</span></p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
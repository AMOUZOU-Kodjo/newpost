 <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Contacts</title>

<link rel="stylesheet" href="style.css">
<body>
     <!-- <?php require 'header.php' ?> -->
   
 <header>
        <a href="index.php" class="logo">E<span>TDV</span></a>
        <nav>
            <a href="index.php" >Accueil</a>
            <a href="about.php">A propos</a>
            <a href="events.php">Programme</a>
            <a href="gallery.php">Galleries</a>
            <a href="emessage.php">Evènements</a>
            <a href="contacts.php" class="active">Contact</a>
            <!-- <a href="login.php">Admin</a> -->
        </nav>
        <button class="menu">☰</button>
    </header>
    <section class="contact active" id="contact">
        <h1>CONTACTS</h1>
        <div class="ligne"></div>
        <!-- <?php include('./traitement.php') ?>  -->
        <div class="contact-container">
            <div class="contact-box">
                <h2 class="h2">Nos Informations</h2>
                <div class="contact-detail">
                    <div class="detail">
                        <a href="#"><i class='bx bxs-contact'></i></a>
                        <p>(+228) 90 33 94 46</p>
                    </div>
                </div>

                <div class="contact-detail">
                    <div class="detail">
                        <a href="#"><i class='bx bx-message-rounded-dots'></i></a>
                        <p>contact@etdv.org </p>
                    </div>
                </div>

                <div class="contact-detail">
                    <div class="detail">
                        <a href="#"><i class='bx bxs-envelope'></i></a>
                        <p>cyrillesada11@gmail.com</p>
                    </div>
                </div>

            </div>
            
            <div class="contact-box">
                
                <form  method="POST">
                    <h2 class="h2">Contact<span>ez - nous</span></h2>
                    <div class="field-box">
                        <input type="text" name="nom" placeholder="Nom " required>
                        <input type="text" name="prenom" placeholder="Prenom" required>
                        <input type="email" name="email" placeholder="Adresse Email" required>
                        <!-- <input type="text" name= placeholder="Autres Email" required> -->
                        <textarea name="message"  placeholder="Message" required></textarea>
                            
                    </div>
                    <button type="submit" name= "submit" class="btn">Soumettre</button>

                </form>

            </div>
        </div>

    </section>
    <?php require 'footer.php' ?>
</body>
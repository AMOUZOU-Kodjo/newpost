 <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Programs</title>

<link rel="stylesheet" href="style.css">
<body>
     <!-- <?php require 'header.php' ?> -->
   
 <header>
        <a href="index.php" class="logo">E<span>TDV</span></a>
        <nav>
            <a href="index.php" >Accueil</a>
            <a href="about.php">A propos</a>
            <a href="events.php" class="active">Programme</a>
            <a href="gallery.php">Galleries</a>
            <a href="emessage.php">Evènements</a>
            <a href="contacts.php">Contact</a>
            <!-- <a href="login.php">Admin</a> -->
        </nav>
        <button class="menu">☰</button>
    </header>
    <section class="events active"  id="event">
        <h1>Nos Programmes</h1>
        <div class="ligne"></div>
        <div class="evente-box">
            <div class="event">
                <div class="event-box box">
                    <button class="btn active">Lundi</button>
                    <button class="btn">Mercredi</button>
                    <button class="btn">Vendredi</button>
                    <button class="btn">Dimanche</button>
                    <button class="btn">Avril</button>
                    <button class="btn">Août</button>
                    <!-- <button class="btn"></button> -->
                </div>
                <div class="event-box">
                    <div class="event-detail lundi active">
                        <h2>Réunion des Jeunes</h2>
                        <div class="event-list">
                            <div class="event-item">
                                <p class="time">17h30 - 19h00</p>
                                <h3>Prières & Enseignements</h3>
                                <p>Séance d'enseignement et de partages : La parole de Dieu au sein de la Jeunesse.</p>
                            </div>
                        </div>
                    </div>
                    <div class="event-detail Mercredi ">
                        <h2>Séance d'auto-délivrance</h2>
                        <div class="event-list">
                            <div class="event-item">
                                <p class="time">19h00 - 21h00</p>
                                <h3>Prières & Délivrances</h3>
                                <p>Moment de concentration dans la prière. Séance d'auto-délivrance et de rencontre individuelle avec le créateur.</p>
                            </div>
                        </div>
                    </div>
                    <div class="event-detail Vendredi ">
                        <h2>Veillée de prière et de délivrance</h2>
                        <div class="event-list">
                            <div class="event-item">
                                <p class="time">19h00 - 21h00</p>
                                <h3>Prières & Délivrances</h3>
                                <h4>Jacques 5 : 15</h4>
                                <p>La prière de la foi sauvera le malade, et le Seigneur le relèvera; et s'il a commis des péchés, il lui sera pardonné.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="event-detail Dimanche ">
                        <h2>Culte de dimanche</h2>
                        <div class="event-list">
                            <div class="event-item">
                                <p class="time">08h00 - 09h00</p>
                                <h3>Ecole de Dimanche</h3>
                                <p class="time">09h00 - 11h00</p>
                                <h3>Culte</h3>
                                <p class="time">15h00 - 17h00</p>
                                <h3>Ministère des femmes</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="event-detail Avril ">
                        <h2>Convention de Pâques</h2>
                        <div class="event-list">
                            <div class="event-item">
                                <p class="time">Avril</p>
                                <h3>Moment de commémoration.</h3>
                                <h4>I Corinthiens 5 : 7</h4>
                                <p>
                                    Faites disparaître le vieux levain, afin que vous soyez une pâte nouvelle, puisque vous êtes sans levain, car
                                    Christ, notre Pâque, a été immolé.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="event-detail Août ">
                        <h2>Convention spirituelle</h2>
                        <div class="event-list">
                            <div class="event-item">
                                <p class="time">Août</p>
                                <h3>Rencontre avec Dieu</h3>
                                <h4>Marc 16 : 15 - 16</h4>
                                <p>Puis il leur dit : Allez par tout le monde, et prêchez la bonne nouvelle à toute la création. Celui qui croira et qui sera baptisé sera sauvé, mais celui qui ne croira pas sera condamné.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require 'footer.php' ?>
        <script src="script.js"></script>
        
</body>
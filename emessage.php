<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Events</title>
<link rel="stylesheet" href="style.css">
<body>
     <!-- <?php require 'header.php' ?> -->
    
 <header>
        <a href="index.php" class="logo">E<span>TDV</span></a>
        <nav>
            <a href="index.php" >Accueil</a>
            <a href="about.php" >A propos</a>
            <a href="events.php">Programme</a>
            <a href="gallery.php">Galleries</a>
            <a href="emessage.php" class="active">Evènements</a>
            <a href="contacts.php">Contact</a>
            <!-- <a href="login.php">Admin</a> -->
        </nav>
        <button class="menu">☰</button>
    </header>
    <section class="emessage active">
        <h1 style="font-size: 2rem; font-weight: 700; text-transform: uppercase;">Evènements</h1>
        <div class="ligne"></div>
        <div class="box">
            <?php include('./messages.php') ?>
        </div>
        
    </section>
    <?php require 'footer.php' ?>
    <script src="script.js"></script>
</body>
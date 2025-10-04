 <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Gallery</title>

<link rel="stylesheet" href="style.css">
<body>
     <!-- <?php require 'header.php' ?> -->
   
 <header>
        <a href="index.php" class="logo">E<span>TDV</span></a>
        <nav>
            <a href="index.php" >Accueil</a>
            <a href="about.php">A propos</a>
            <a href="events.php">Programme</a>
            <a href="gallery.php" class="active">Galleries</a>
            <a href="emessage.php">Evènements</a>
            <a href="contacts.php">Contact</a>
            <!-- <a href="login.php">Admin</a> -->
        </nav>
        <button class="menu">☰</button>
    </header>
    <section class="gallerie active">
        <h1>Galleries</h1>
        <div class="ligne"></div>
        <div class="button">
            <button class="btns images active">images</button>
            <button class="btns videos">videos</button>
        </div>
        <div class="contenus images active">
            <?php include('./images.php') ?>
        </div>
        <div class="contenus videos">
            <?php include('./videos.php') ?>
        </div>
    </section>
    <?php require 'footer.php' ?>
    <script src="script.js"></script>
</body>
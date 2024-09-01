<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Co-Lock Bureaux</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>

    <div class="header">
        <span class="menu-icon" onclick="openNav()">&#9776;</span>
        <img src="../images/logo.png" alt="Co-Lock Logo" class="logo">
        <div class="profile-icon">&#128100;</div>
    </div>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.html">Accueil</a>
        <a href="Formulaire.html">Créer une annonce (Bureaux)</a>
        <a href="#">Créer une annonce (Entreprise)</a>
        <a href="#">voir les entreprises</a>
        <a href="#">Contact</a>
    </div>

    <div class="container" id="cards-container">
        <!-- Les cartes seront insérées ici dynamiquement -->
    </div>

    <a href="#" class="view-all">View All</a>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "20%";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        // Fonction pour créer une nouvelle carte
        function createCard(imageSrc, title, price) {
            const card = document.createElement('div');
            card.className = 'card';

            const img = document.createElement('img');
            img.src = imageSrc;
            img.alt = title;

            const h3 = document.createElement('h3');
            h3.textContent = title;

            const p = document.createElement('p');
            p.textContent = price ? price + ' €' : '';

            card.appendChild(img);
            card.appendChild(h3);
            card.appendChild(p);

            document.getElementById('cards-container').appendChild(card);
        }

        // Fonction pour charger les annonces
        async function loadAnnonces() {
            try {
                const response = await fetch('connexion.php'); // Le fichier PHP qui retourne les annonces
                const annonces = await response.json();

                annonces.forEach(annonce => {
                    createCard(annonce.image, annonce.title, annonce.price);
                });
            } catch (error) {
                console.error('Erreur lors du chargement des annonces:', error);
            }
        }

        // Charger les annonces au chargement de la page
        loadAnnonces();
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage de l'Annonce</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/Formulaire.css">
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.html">Accueil</a>
        <a href="EntrepriseListe.html">Voir les entreprises</a>
        <a href="Formulaire.html">Créer une annonce (Bureaux)</a>
        <a href="FormulaireEntreprise.html">Créer une annonce (Entreprise)</a>
        <a href="Contact.html">Contact</a>
    </div>

    <div class="container">
        <h1>Détails de l'Annonce</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer les données du formulaire
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);
            $city = htmlspecialchars($_POST['city']);
            $address = htmlspecialchars($_POST['address']);

            // Affichage des données
            echo "<div class='form-group'><strong>Nom de l'annonce:</strong> $title</div>";
            echo "<div class='form-group'><strong>Description:</strong> $description</div>";
            echo "<div class='form-group'><strong>Prix:</strong> $price €</div>";
            echo "<div class='form-group'><strong>Ville:</strong> $city</div>";
            echo "<div class='form-group'><strong>Adresse:</strong> $address</div>";
        } else {
            echo "<p>Aucune donnée soumise.</p>";
        }
        ?>
    </div>
</body>
</html>

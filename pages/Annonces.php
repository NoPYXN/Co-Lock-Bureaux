<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage de l'Annonce</title>
    <link rel="stylesheet" href="../css/Formulaire.css">
</head>
<body>
    <div class="header">
        <div class="menu-icon">&#9776;</div>
        <img src="../images/logo.png" alt="Co-Lock Logo">
        <div class="profile-icon">&#128100;</div>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Co-Lock Bureaux</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/index.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .sidenav a {
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }
        .sidenav a:hover {
            background-color: #575757;
        }
        .button-home {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .button-home:hover {
            background-color: #0056b3;
        }
        .message {
            font-size: 18px;
            color: #28a745;
            margin-bottom: 20px;
        }
    </style>
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
        <a href="EntrepriseListe.html">Voir les entreprises</a>
        <a href="Formulaire.html">Créer une annonce (Bureaux)</a>
        <a href="FormulaireEntreprise.html">Créer une annonce (Entreprise)</a>
        <a href="Contact.html">Contact</a>
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "20%";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

    <div class="container">
        <?php
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root"; // Remplacez par votre nom d'utilisateur MySQL
        $password = "root"; // Remplacez par votre mot de passe MySQL
        $dbname = "co_lock"; // Remplacez par le nom de votre base de données

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer et sécuriser les données du formulaire
    $nom = $conn->real_escape_string($_POST['companyName']);
    $description = $conn->real_escape_string($_POST['description']);
    $ville = $conn->real_escape_string($_POST['city']);
    $address = $conn->real_escape_string($_POST['localAddress']);
    $logo = $conn->real_escape_string($_POST['logo']);
    $email = $conn->real_escape_string($_POST['email']);
    
    // Gestion de l'image uploadée
    $logo = NULL;
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $imageName = basename($_FILES["logo"]["name"]);
        $targetDir = "../images/"; // Dossier où l'image sera enregistrée
        $targetFilePath = $targetDir . $imageName;

                // Vérifier si le fichier est une image valide
                $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["logo"]["tmp_name"]);
                if($check !== false) {
                    // Déplacer l'image vers le dossier cible
                    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFilePath)) {
                        $logo = $imageName; // Enregistrer le nom de l'image en base de données
                    } else {
                        echo "Erreur lors du téléchargement de l'image.";
                    }
                } else {
                    echo "Le fichier n'est pas une image valide.";
                }
            }

    // Requête SQL pour insérer les données
    $sql = "INSERT INTO annonces_entreprise (nom_entreprise, description_entreprise, ville, adresse_entreprise, logo, email)
            VALUES ('$nom', '$description', '$ville', '$address', '$logo', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='message'>Nouvelle annonce créée avec succès.</p>";
            } else {
                echo "Erreur: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
        ?>
        <a href="index.php" class="button-home">Retour à l'accueil</a>
    </div>

</body>
</html>

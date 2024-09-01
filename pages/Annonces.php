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
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $price_hour = $conn->real_escape_string($_POST['price_hour']);
    $price_day = $conn->real_escape_string($_POST['price_day']);
    $price_week = $conn->real_escape_string($_POST['price_week']);
    $city = $conn->real_escape_string($_POST['city']);
    $address = $conn->real_escape_string($_POST['address']);
    $email = $conn->real_escape_string($_POST['email']);
    
    // Gestion de l'image uploadée
    $image = NULL;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = basename($_FILES["image"]["name"]);
        $targetDir = "../images/"; // Dossier où l'image sera enregistrée
        $targetFilePath = $targetDir . $imageName;

        // Vérifier si le fichier est une image valide
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            // Déplacer l'image vers le dossier cible
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $image = $imageName; // Enregistrer le nom de l'image en base de données
            } else {
                echo "Erreur lors du téléchargement de l'image.";
            }
        } else {
            echo "Le fichier n'est pas une image valide.";
        }
    }

    // Requête SQL pour insérer les données
    $sql = "INSERT INTO annonces (title, description, price_hour, price_day, price_week, city, address, image, email)
            VALUES ('$title', '$description', '$price_hour', '$price_day', '$price_week', '$city', '$address', '$image', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle annonce créée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

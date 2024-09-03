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

// Requête pour récupérer les entreprises
$sql = "SELECT nom_entreprise AS title, logoEntreprise AS image FROM entreprises"; 
$result = $conn->query($sql);

$entreprises = [];

if ($result->num_rows > 0) {
    // Parcourir les résultats et les ajouter au tableau
    while ($row = $result->fetch_assoc()) {
        $entreprises[] = [
            'title' => $row['nom_entreprise'],
            'image' => $row['logoEntreprise'] ? $row['logoEntreprise'] : 'Bureau1.jpg'
        ];
    }
}

// Fermer la connexion
$conn->close();

// Retourner les données au format JSON
header('Content-Type: application/json');
echo json_encode($entreprises);
?>

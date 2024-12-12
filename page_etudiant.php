<?php
// Démarrer la session et inclure le fichier de connexion
session_start();
include 'connexion.php'; // Assure-toi que $conn est correctement défini dans ce fichier

// Vérifier si l'utilisateur est connecté via une variable de session
if (!isset($_SESSION['user_id'])) {
    header("Location: formulaire_connexion.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Récupérer l'identifiant de l'utilisateur depuis la session
$user_id = $_SESSION['user_id'];

// Créer une requête SQL pour récupérer les informations de l'utilisateur
$sql = "SELECT nom, prenom, email FROM etudiants WHERE idetu = ?"; // Remplace "etudiants" par le nom approprié de ta table si différent
$stmt = $conn->prepare($sql); // Préparer la requête SQL pour empêcher les injections SQL
$stmt->bind_param("i", $user_id); // Associer l'identifiant de l'utilisateur comme paramètre
$stmt->execute(); // Exécuter la requête
$result = $stmt->get_result(); // Obtenir le résultat de la requête

// Vérifier si l'utilisateur existe dans la base de données
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Récupérer les informations de l'utilisateur sous forme de tableau associatif
} else {
    echo "Utilisateur non trouvé."; // Afficher un message d'erreur si l'utilisateur n'est pas trouvé
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Plateforme de Parrainage</title>
    <!-- Importation des polices et des styles -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-dyBax3AAMHdt34r2RMBJrYbiQsKm8iTpCUuXVJ3aSpgF8FsjF8z9of4Id+WoSp5f" crossorigin="anonymous">
    <link rel="stylesheet" href="css/page_etudiant.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="./image/UIYA.png" alt="Logo">
        </div>
        <nav class="nav-menu">
            <!-- Menu de navigation -->
            <a href="#">Accueil</a>
            <a href="rencontre.html">Rencontre</a>
            <a href="activite.html">Activité</a>
            <a href="#">Parrains & Filleuls</a>
        </nav>
        <div class="user-menu">
            <!-- Menu utilisateur avec icônes et affichage du nom -->
            <div class="profile-circle">
                <a href="mofifier.html"><img src="path/to/your/photo.jpg" alt="Photo de Profil"></a>
            </div>
            <i class="fas fa-bell"></i>
            <i class="fas fa-user-circle"></i>
        </div>
    </header>
    <div class="welcome">
        <!-- Message de bienvenue personnalisé -->
        <h1>Bienvenue <br><?= htmlspecialchars($user['prenom'] . " " . $user['nom']) ?></h1>
    </div>
</body>
</html>
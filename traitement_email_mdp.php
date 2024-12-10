<?php
session_start();
// Connexion à la base de données
require('connexion.php');  // Remplace par ton fichier de connexion à la DB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $matricule = $_POST['matricule'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $contact = $_POST['contact'];  // Récupération du contact

    // Hachage du mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // Mise à jour des informations dans la base de données
    $sql = "UPDATE etudiants SET email = :email, mot_de_passe = :mot_de_passe, contact = :contact WHERE matricule = :matricule";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe_hash);
    $stmt->bindParam(':contact', $contact);  // On lie la variable contact
    $stmt->bindParam(':matricule', $matricule);
    $stmt->execute();

    // Redirection vers la page de connexion
    header('Location: formulaire_connexion.php');
    exit;
}
?>

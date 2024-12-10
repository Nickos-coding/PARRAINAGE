<?php
// Initialiser la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost';  // Hôte de la base de données
$dbname = 'parrainage_db';  // Nom de la base de données
$username = 'root';  // Nom d'utilisateur de la base de données
$password = '';  // Mot de passe de la base de données

try {
    // Vérifie si une connexion PDO n'est pas déjà en cours
    if (!isset($pdo)) {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
} catch (PDOException $e) {
    // Désactiver les messages détaillés en production
    error_log("Erreur de connexion à la base de données : " . $e->getMessage());
    die("Une erreur est survenue. Veuillez réessayer plus tard.");
}

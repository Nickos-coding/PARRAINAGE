<?php
session_start();
// Connexion à la base de données
require('connexion.php');  // Remplace par ton fichier de connexion à la DB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérification si l'email existe dans la table utilisateurs (administrateurs)
    $sql_utilisateur = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt_utilisateur = $pdo->prepare($sql_utilisateur);
    $stmt_utilisateur->bindParam(':email', $email);
    $stmt_utilisateur->execute();

    // Si un administrateur avec cet email existe
    if ($stmt_utilisateur->rowCount() > 0) {
        // Récupérer les données de l'administrateur
        $utilisateur = $stmt_utilisateur->fetch();

        // Vérification du mot de passe
        if (password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            // Authentification réussie, redirection vers la page administrateur
            session_start();
            $_SESSION['email'] = $email;
            header('Location: page_admin.php'); // Redirection vers la page de l'administrateur
            exit;
        } else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect pour l'administrateur.";
        }
    } else {
        // Si l'email n'est pas dans la table utilisateurs, vérification dans la table etudiants
        $sql_etudiant = "SELECT * FROM etudiants WHERE email = :email";
        $stmt_etudiant = $pdo->prepare($sql_etudiant);
        $stmt_etudiant->bindParam(':email', $email);
        $stmt_etudiant->execute();

        // Si un étudiant avec cet email existe
        if ($stmt_etudiant->rowCount() > 0) {
            // Récupérer les données de l'étudiant
            $etudiant = $stmt_etudiant->fetch();

            // Vérification du mot de passe
            if (password_verify($mot_de_passe, $etudiant['mot_de_passe'])) {
                // Authentification réussie, redirection vers la page étudiant
                session_start();
                $_SESSION['email'] = $email;
                header('Location: page_etudiant.php'); // Redirection vers la page de l'étudiant
                exit;
            } else {
                // Mot de passe incorrect
                echo "Mot de passe incorrect pour l'étudiant.";
            }
        } else {
            // Email non trouvé
            echo "Email non trouvé dans la base de données.";
        }
    }
}
?>

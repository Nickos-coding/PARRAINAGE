<?php
session_start();
// Connexion à la base de données
require('connexion.php'); // Fichier de connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérification si l'email existe déjà
    $sql_verification = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt_verification = $pdo->prepare($sql_verification);
    $stmt_verification->bindParam(':email', $email);
    $stmt_verification->execute();

    if ($stmt_verification->rowCount() > 0) {
        // L'email existe déjà
        echo "Cet email est déjà enregistré comme utilisateur.";
    } else {
        // Hachage du mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Insertion dans la base de données
        $sql_insertion = "INSERT INTO utilisateurs (email, mot_de_passe) VALUES (:email, :mot_de_passe)";
        $stmt_insertion = $pdo->prepare($sql_insertion);
        $stmt_insertion->bindParam(':email', $email);
        $stmt_insertion->bindParam(':mot_de_passe', $mot_de_passe_hash);

        if ($stmt_insertion->execute()) {
            echo "Utilisateur ajouté avec succès !";
        } else {
            echo "Une erreur est survenue lors de l'ajout de l'utilisateur.";
        }
    }
}
?>

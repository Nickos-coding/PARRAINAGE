<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require_once 'connexion.php';

// Vérifier si la connexion à la base de données a été établie
if (!isset($conn) || $conn->connect_error) {
    die("Erreur de connexion à la base de données.");
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    // Préparer une requête pour vérifier les identifiants de l'utilisateur
    $sql = "SELECT idetu, mot_de_passe FROM etudiants WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Récupérer les données de l'utilisateur
            $user = $result->fetch_assoc();

            // Vérifier le mot de passe
            if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
                // Authentification réussie
                $_SESSION['user_id'] = $user['idetu'];
                header("Location: page_etudiant.php");
                exit();
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Email non trouvé.";
        }
    } else {
        echo "Erreur dans la préparation de la requête.";
    }
} else {
    header("Location: formulaire_connexion.php");
    exit();
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Traitement du formulaire de première connexion

    // Enregistrement du cookie
    setcookie('premiere_connexion_complete', 'oui', time() + (30 * 24 * 60 * 60), "/"); // Cookie valable 30 jours

    // Redirection vers le formulaire suivant en fonction de la réponse (matricule ou inscription)
    if (isset($_POST['premiere_connexion']) && $_POST['premiere_connexion'] == 'oui') {
        header('Location: premiere_connexion_matricule.php'); // Redirection vers formulaire matricule
        exit;
    } else {
        header('Location: formulaire_connexion.php'); // Redirection vers formulaire de connexion classique
        exit;
    }
}
?>

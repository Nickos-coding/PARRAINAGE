<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYGES PROPUS - Accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>

    <header>
        <div class="logo">
            <img src="./image/UIYA.png" alt="logo"> <!-- Logo modifié en texte -->
        </div>


        <div class="login">
            <!-- Lien de connexion redirigeant vers le formulaire adapté en fonction du cookie -->
            <a href="#" class="login-btn" id="login-btn">
                Se connecter
            </a>
        </div>
    </header>

    
    <main class="content">
        <h1 class="welcome-text">Bienvenue 
             sur votre site SYGES Propus</h1>
    </main>
    <footer>
        Copyright © 2024 Propus - Tous droits réservés.
    </footer>

    

    <script>
        // Fonction pour afficher le contenu correspondant au lien cliqué
        function showContent(section) {
            // Cacher toutes les sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => section.style.display = 'none');
            
            // Afficher la section correspondante
            document.getElementById(section).style.display = 'block';
        }

        // Vérification de la présence du cookie 'premiere_connexion_complete'
        if (document.cookie.indexOf('premiere_connexion_complete') === -1) {
            // Si le cookie n'existe pas, l'étudiant doit compléter le formulaire de première connexion
            document.getElementById('login-btn').href = "premco.html";
        } else {
            // Si le cookie existe, l'étudiant est redirigé vers la page de connexion classique
            document.getElementById('login-btn').href = "formulaire_connexion.php"; // Remplace par ton formulaire de connexion
        }
    </script>

    <script src="js/index.js"></script> <!-- Lien vers le fichier JS -->
</body>
</html>

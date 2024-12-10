<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - SYGES PROPUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/formulaire_connexion.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>

    <header>
        <div class="logo">
            <img src="image/UIYA.png" alt="Logo">
        </div>
    </header>

    <main>
        <div class="form-container">
            <h2>Veuillez entrer vos identifiants</h2>
            <form action="traitement_connexion.php" method="POST">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
                
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 SYGES PROPUS - Tous droits réservés</p>
    </footer>

</body>
</html>

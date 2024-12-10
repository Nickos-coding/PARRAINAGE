<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Première Connexion - SYGES PROPUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/formulaire_matricule.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>

    <header>
        <div class="logo">
            <img src="image/UIYA.png" alt="Logo">
        </div>
    </header>

    <main>
        <div class="form-container">
            <h2>Première connexion</h2>
            <form action="traitement_matricule.php" method="POST">
                <label for="matricule">Matricule :</label>
                <input type="text" id="matricule" name="matricule" required>
                
                <button type="submit">Valider</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 SYGES PROPUS - Tous droits réservés</p>
    </footer>

</body>
</html>

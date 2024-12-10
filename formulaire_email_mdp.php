<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Première Connexion - SYGES PROPUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/formulaire_email_mdp.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>

    <header>
        <div class="logo">
            <img src="image/UIYA.png" alt="Logo">
        </div>
    </header>

    <main>
        <div class="form-container">
            <h2>Complétez votre inscription</h2>
            <form action="traitement_email_mdp.php" method="POST" onsubmit="return validerContact()">
                <label for="matricule">Matricule :</label>
                <input type="text" id="matricule" name="matricule" value="<?php echo $_GET['matricule']; ?>" readonly>
                
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="exemple@gmail.com" required>
                
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                
                <!-- Champ Contact -->
                <label for="contact">Numéro de téléphone :</label>
                <input type="text" id="contact" placeholder="Votre numero de telephone svp " name="contact" maxlength="10" pattern="^[0-9]{10}$" required><br>

                
                <button type="submit">Valider</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 SYGES PROPUS - Tous droits réservés</p>
    </footer>
<script src="js/formulaire_email_mdp.js"></script>
</body>
</html>

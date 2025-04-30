<?php
/*
 * EXEMPLE COMPLET DE GESTION DE SESSION
 * Cet exemple montre comment :
 * 1. Démarrer une session
 * 2. Stocker des données dans la session
 * 3. Persister des informations entre les pages
 */

// 1. DÉMARRAGE DE LA SESSION - Doit être la première instruction
// Crée un fichier temporaire sur le serveur et un cookie PHPSESSID chez le client
session_start();

// 2. INITIALISATION DU COMPTEUR
// Vérifie si la variable de session existe, sinon la crée
if (!isset($_SESSION['visites'])) {
    $_SESSION['visites'] = 0; // Initialisation à 0
    $_SESSION['premiere_visite'] = date('d/m/Y H:i:s'); // Date de première visite
}

// 3. INCÉMENTATION DU COMPTEUR
// À chaque rafraîchissement, le compteur augmente
$_SESSION['visites']++;
// Mise à jour de la dernière visite
$_SESSION['derniere_visite'] = date('d/m/Y H:i:s');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Exemple de Session PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Exemple Pratique de Sessions</h1>
        
        <div class="alert alert-info">
            <p>Nombre de visites : <?php echo $_SESSION['visites']; ?></p>
            <?php if ($_SESSION['visites'] > 1): ?>
                <p>Dernière visite : <?php echo $_SESSION['derniere_visite']; ?></p>
                <p>Première visite : <?php echo $_SESSION['premiere_visite']; ?></p>
            <?php endif; ?>
        </div>
        
        <div class="code-block">
            <h3>Code source :</h3>
            <pre><?php highlight_file(__FILE__); ?></pre>
        </div>
    </div>
</body>
</html>

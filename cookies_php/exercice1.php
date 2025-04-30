<?php
// Vérifie si le formulaire a été soumis
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['langue'])) {
    // Stocke la langue dans un cookie (30 jours)
    setcookie('langue', $_POST['langue'], time() + (86400 * 30), "/");
    header('Location: '.$_SERVER['PHP_SELF']);
    exit;
}

// Messages dans différentes langues
$messages = [
    'fr' => 'Bienvenue sur notre site!',
    'en' => 'Welcome to our website!'
];

// Détermine la langue actuelle
$langue = $_COOKIE['langue'] ?? 'fr';
?>
<!DOCTYPE html>
<html lang="<?= $langue === 'en' ? 'en' : 'fr' ?>">
<head>
    <meta charset="UTF-8">
    <title>Exercice Préférence Langue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1><?= $messages[$langue] ?></h1>
        
        <form method="post" class="mt-4">
            <div class="mb-3">
                <label class="form-label">Changer la langue:</label>
                <select name="langue" class="form-select">
                    <option value="fr" <?= $langue === 'fr' ? 'selected' : '' ?>>Français</option>
                    <option value="en" <?= $langue === 'en' ? 'selected' : '' ?>>English</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</body>
</html>

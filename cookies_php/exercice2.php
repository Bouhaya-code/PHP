<?php
// Initialisation
session_start();

// Action pour ajouter un article
if(isset($_POST['ajouter_article']) && !empty($_POST['article'])) {
    // On récupère le panier existant ou on en crée un nouveau
    $panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : [];
    
    // On ajoute le nouvel article
    $article = htmlspecialchars($_POST['article']);
    $panier[] = $article;
    
    // On sauvegarde le panier mis à jour dans un cookie (valide pour 1 jour)
    setcookie('panier', json_encode($panier), time() + 86400, '/');
    
    // Pour une mise à jour immédiate de l'affichage
    $_COOKIE['panier'] = json_encode($panier);
}

// Action pour vider le panier
if(isset($_POST['vider_panier'])) {
    // On supprime le cookie en définissant une date d'expiration passée
    setcookie('panier', '', time() - 3600, '/');
    
    // On vide également la valeur en mémoire
    $_COOKIE['panier'] = null;
}

// Récupération du panier pour affichage
$panier = isset($_COOKIE['panier']) ? json_decode($_COOKIE['panier'], true) : [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice Panier d'Achat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Mon Panier d'Achat</h1>
        
        <!-- Formulaire pour ajouter un article -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Ajouter un article
            </div>
            <div class="card-body">
                <form method="post" class="d-flex">
                    <input type="text" name="article" class="form-control me-2" placeholder="Nom de l'article" required>
                    <button type="submit" name="ajouter_article" class="btn btn-success">Ajouter</button>
                </form>
            </div>
        </div>
        
        <!-- Affichage du contenu du panier -->
        <div class="card">
            <div class="card-header bg-info text-white">
                Contenu du Panier
            </div>
            <div class="card-body">
                <?php if(empty($panier)): ?>
                    <p class="text-muted">Votre panier est vide.</p>
                <?php else: ?>
                    <ul class="list-group">
                        <?php foreach($panier as $article): ?>
                            <li class="list-group-item"><?= $article ?></li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <div class="mt-3">
                        <form method="post">
                            <button type="submit" name="vider_panier" class="btn btn-danger">Vider le panier</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="mt-4">
            <a href="index.html" class="btn btn-outline-primary">Retour au cours</a>
        </div>
    </div>
</body>
</html>

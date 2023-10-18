<?php
include '../util/categorie.php';

$categories = getAllCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = (float)$_POST['prix']; // Conversion en float
    $image_url = $_POST['image'];
    $categorieID = (int)$_POST['categorieID']; // Conversion en int

    try {
        $produitID = addProduit($nom, $description, $prix, $image_url, $categorieID);
        echo "Ajout effectué !";
        // Redirection vers la page souhaitée
        header('Location: index.php'); // Assurez-vous que le nom du fichier est correct
        exit;
    } catch (Exception $e) {
        echo "Problème : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
    <title>Admin: Ajout de produit</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../">Administration</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="afficheProduits.php">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" style="font-weight: bold;" aria-current="page" href="ajouteProduit.php">Nouveau</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="supprimeProduits.php">Suppression</a>
                </li>
            </ul>
            <div style="margin-right: 500px">
                <h5 style="color: #545659; opacity: 0.5;">Connecté en tant que: XXXX</h5>
            </div>
            <a class="btn btn-danger d-flex" style="display: flex; justify-content: flex-end;" href="destroy.php">Se déconnecter</a>
        </div>
    </div>
</nav>
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <form method="post">
                <div class="mb-3">
                    <label for="categorieID">Sélectionnez une catégorie :</label>
                    <select id="categorieID" name="categorieID">
                        <?php
                        foreach ($categories as $categorie): ?>
                            <option value="<?= $categorie['categorieid'] ?>"><?= $categorie['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="number" class="form-control" name="prix" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">L'image du produit</label>
                    <input type="text" class="form-control" name="image" required>
                </div>
                <button type="submit" name="valider" class="btn btn-primary">Ajouter un nouveau produit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

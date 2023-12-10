<?php
session_start();
$_SESSION['page_avant_login'] = $_SERVER['REQUEST_URI'];

include '../util/users.php';

// Vérifiez si l'utilisateur est connecté en tant qu'admin
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../login.php");
}

$clientID =$_SESSION['clientID'];
$admin = getUserByID($clientID);

// Récupérez toutes les catégories
$categories = getAllCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['categorieID'])) {
        $categorieID = (int)$_POST['categorieID'];

        // Assurez-vous que la catégorie existe avant de la supprimer
        if (!empty(getCategorieByID($categorieID))) {
            // Appelez votre fonction de suppression de catégorie
            deleteCategorie($categorieID);

            // Redirigez l'utilisateur vers la liste des catégories
            header('Location: afficheCategories.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
    <title>Suppression de Catégorie</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Administration</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="afficheCategories.php">Catégories</a>
                </li>
            </ul>
            <div style="margin-right: 500px">
                <h5 style="color: #545659; opacity: 1.5;">Connecté en tant que: <b style="color: chocolate"><?php echo $admin['nom'].' '.$admin['prenom'] ?></b></h5>
            </div>
            <a class="btn btn-danger d-flex" style="display: flex; justify-content: flex-end;" href="../deconnexion.php">Se déconnecter</a>
        </div>
    </div>
</nav>
<div class="container">
    <h1>Suppression de Catégorie</h1>
    <form method="post">
        <div class="mb-3">
            <label for="categorieID">Sélectionnez la catégorie à supprimer :</label>
            <select id="categorieID" name="categorieID" class="form-select">
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['categorieid'] ?>"><?= $categorie['nom'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-danger">Supprimer</button>
        <a class="btn btn-secondary" href="afficheCategories.php">Annuler</a>
    </form>
</div>
</body>
</html>

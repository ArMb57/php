<?php
require 'bdd.php';

$db= Database::connect();

// Récupérer toutes les categs parentes 
$query = "SELECT * FROM categories WHERE parent = 0";
// FETCH_ASSOC pour récupérer les données sous forme de tableau associatif car de base il renvoie un tableau associatif et un tableau indexé
$parentCategs = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);


// Récupérer toutes les categs enfants
$query = "SELECT * FROM categories WHERE parent != 0";
$childCategs = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-commerce test </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <?php foreach($parentCategs as $categ) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <?= htmlspecialchars($categ['nom']); ?>
          </a>
          <ul class="dropdown-menu">
            <?php foreach($childCategs as $childCateg) { 
                if ($childCateg['parent'] === $categ['id']){?>
            <li><a class="dropdown-item" href="#"><?= htmlspecialchars($childCateg['nom']); ?></a></li>
            <?php }
         } ?>
          </ul>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>

    




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
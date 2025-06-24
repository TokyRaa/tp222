<?php include('../inc/connexion.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Recherche Employés</title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body class="bg-light">

<header class="bg-dark text-white p-3">
  <div class="container">
    <h1 class="h4">🔍 Recherche d'Employés</h1>
  </div>
</header>

<main class="container py-4">

  <form method="get" action="recherche.php" class="bg-white p-4 shadow rounded">

    <div class="row mb-3">
      <div class="col-md-4">
        <label for="dept" class="form-label">Département</label>
        <select name="dept_no" id="dept" class="form-select">
          <option value="">-- Tous les départements --</option>
          <?php
          $res = $conn->query("SELECT * FROM departments");
          while ($dept = $res->fetch_assoc()):
          ?>
            <option value="<?= $dept['dept_no'] ?>"><?= $dept['dept_name'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="col-md-4">
        <label for="nom" class="form-label">Nom ou Prénom contient</label>
        <input type="text" name="nom" id="nom" class="form-control" placeholder="ex: Toky">
      </div>

      <div class="col-md-2">
        <label for="age_min" class="form-label">Âge min</label>
        <input type="number" name="age_min" id="age_min" class="form-control" placeholder="18">
      </div>

      <div class="col-md-2">
        <label for="age_max" class="form-label">Âge max</label>
        <input type="number" name="age_max" id="age_max" class="form-control" placeholder="65">
      </div>
    </div>

    <button type="submit" class="btn btn-primary">🔍 Rechercher</button>
  </form>

</main>
</body>
</html>

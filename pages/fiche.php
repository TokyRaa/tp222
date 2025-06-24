<?php
include('../inc/connexion.php');

// Récupérer le numéro de l'employé
if (isset($_GET['emp_no'])) {
    $emp_no = intval($_GET['emp_no']);

    // Requête 1 : Info principale
    $sqlEmp = "SELECT * FROM employees WHERE emp_no = $emp_no";
    $emp = $conn->query($sqlEmp)->fetch_assoc();

    // Requête 2 : Historique des salaires
    $sqlSalaires = "SELECT salaries, from_date, to_date FROM salaries WHERE emp_no = $emp_no";
    $salaires = $conn->query($sqlSalaires);

    // Requête 3 : Historique des postes
    $sqlTitles = "SELECT title, from_date, to_date FROM titles WHERE emp_no = $emp_no";
    $titles = $conn->query($sqlTitles);

} else {
    echo "Aucun employé sélectionné.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche Employé</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<header class="bg-dark text-white p-3">
    <div class="container">
        <h1 class="h4">👤 Fiche de l'Employé #<?= $emp_no ?></h1>
    </div>
</header>

<main class="container py-4">

    <section class="mb-4">
        <h2 class="h5">Informations Générales</h2>
        <ul class="list-group">
            <li class="list-group-item">Nom : <?= $emp['last_name'] ?></li>
            <li class="list-group-item">Prénom : <?= $emp['first_name'] ?></li>
            <li class="list-group-item">Genre : <?= $emp['gender'] ?></li>
            <li class="list-group-item">Date de naissance : <?= $emp['birth_date'] ?></li>
            <li class="list-group-item">Date d'embauche : <?= $emp['hire_date'] ?></li>
        </ul>
    </section>

    <section class="mb-4">
        <h2 class="h5">📈 Historique des salaires</h2>
        <table class="table table-sm table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>Salaire</th>
                    <th>De</th>
                    <th>À</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $salaires->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['salary'] ?> $</td>
                    <td><?= $row['from_date'] ?></td>
                    <td><?= $row['to_date'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2 class="h5">🏷️ Titres occupés</h2>
        <table class="table table-sm table-striped">
            <thead class="table-secondary">
                <tr>
                    <th>Titre</th>
                    <th>De</th>
                    <th>À</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $titles->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['from_date'] ?></td>
                    <td><?= $row['to_date'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <nav class="mt-4">
        <a href="javascript:history.back()" class="btn btn-secondary">← Retour</a>
    </nav>

</main>

</body>
</html>

<?php
include('../inc/connexion.php');

if (isset($_GET['dept_no'])) {
    $dept_no = $_GET['dept_no'];

    $sql = "SELECT e.emp_no, e.first_name, e.last_name, e.gender, e.hire_date
            FROM employees e
            JOIN dept_emp de ON e.emp_no = de.emp_no
            WHERE de.dept_no = '$dept_no'
            LIMIT 100";

    $result = $conn->query($sql);
} else {
    echo "❌ Aucun département sélectionné.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des employés</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

    <header class="bg-dark text-white p-3">
        <div class="container">
            <h1 class="h3">Entreprise XYZ</h1>
        </div>
    </header>

    <main class="container py-4">
        <section>
            <h2 class="mb-4">👥 Employés du département <?= htmlspecialchars($dept_no) ?></h2>

            <nav class="mb-3">
                <a href="departements.php" class="btn btn-secondary">← Retour aux départements</a>
            </nav>

            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Numéro</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Sexe</th>
                        <th>Date d'embauche</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['emp_no'] ?></td>
                                <td colspan="2">
                                    <a href="fiche.php?emp_no=<?= $row['emp_no'] ?>">
                                          <?= $row['last_name'] . ' ' . $row['first_name'] ?>
                                    </a>
                                </td>                              
                                <td><?= $row['gender'] ?></td>
                                <td><?= $row['hire_date'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">Aucun employé trouvé.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer class="bg-dark text-white text-center p-3 mt-4">
        <small>© 2025 Toky & Binôme — Projet L1</small>
    </footer>

</body>
</html>

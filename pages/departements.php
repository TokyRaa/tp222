<?php
include('../inc/connexion.php');

$sql = "SELECT d.dept_no, d.dept_name, e.first_name, e.last_name
        FROM departments d
        JOIN dept_manager dm ON d.dept_no = dm.dept_no
        JOIN employees e ON dm.emp_no = e.emp_no";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des départements</title>
        <link href="css/bootstrap.css" rel="stylesheet" />
        <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

    <header class="bg-primary text-white p-3">
        <div class="container">
            <h1 class="h3">📋 Listes des Départements</h1>
        </div>
    </header>

    <main class="container py-4">
        <section>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Code</th>
                        <th>Département</th>
                        <th>Manager</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['dept_no'] ?></td>
                                <td><?= $row['dept_name'] ?></td>
                                <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                                <td>
                                    <a href="employes.php?dept_no=<?= $row['dept_no'] ?>" class="btn btn-sm btn-outline-primary">
                                        Voir les employés
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center">Aucun département trouvé.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer class="bg-dark text-white text-center p-3">
        <small>© 2025 Toky & Binôme — Projet L1</small>
    </footer>

</body>
</html>
